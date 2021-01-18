#!/bin/bash

read oldrev newrev refname

#
# To enable this hook
# place in .git/hooks
# Run: git config receive.denyCurrentBranch false
# ensure this file has execute writes
# Run: chmod u+x .git/hooks/post-receive

cd ..

GIT_DIR="$(pwd)/.git"

branch=$(git rev-parse --symbolic --abbrev-ref $refname)

if [ "master" != "$branch" ]
then
  exit 0
fi

vendor/bin/wp maintenance-mode activate

git reset --hard

if [[ $(git diff --name-only $oldrev..$newrev composer.lock) ]]
then
  composer install
fi

if [[ $(git diff --name-only $oldrev..$newrev yarn.lock) ]]
then
  yarn install
  yarn run production
elif [[ $(git diff --name-only $oldrev..$newrev public/content/themes/bespoke-theme/assets)   ]]
then
  yarn run production
fi

echo "" | sudo -S service php7.4-fpm reload

vendor/bin/wp core update-db

vendor/bin/wp theme rebuild-pages

vendor/bin/wp maintenance-mode deactivate
