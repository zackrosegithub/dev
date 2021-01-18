# wordpress-template

DO NOT USE THIS REPOSITORY FOR INDIVIDUAL PROJECTS.
But Feel free to create a branch / pull request with any changes you think could improve the template

## Download
to use template please clone the repository, delete the .git folder and reinitialise
```bash
git clone git@github.com:Staxoweb/wordpress-template.git project-name
cd project-name
rm -rf .git/
git init
```



## Setup
copy `.env.example` to `.env`

Replace the wordpress salts in the `.env` file
https://roots.io/salts.html

Edit the `.env` file to match the config needed for that environment only, as it will not be included with the git repository. Make that each environment has this file.

### Docker
To spin up docker, simply enter the project folder
```bash
cd project-name
```
and run
```bash
docker-compose -d up
```

Ensure that you shutdown afterwards before starting a new one
```bash
docker-compose down
```

### Dependancies
Install the core, plugins and asset dependancies

ensure you spin up the docker environment first

```bash
docker exec project-name_web_1 composer install
yarn
yarn run development
```




### STMP
Note that a smtp is achieved via custom function rather than a plugin, as they are configured in code so that the smtp settings can be different for each environment (see `.env`).

SO DO **NOT** INSTALL `easy-wp-smtp` Plugin

### Theme
login to the wp-admin, which is now at `https://localhost:442/wp/wp-admin/`
Activate the theme, also all the plugins

## Development

### Plugins
Plugin manage has been disabled in the wp-admin, all plugins need to be configured via `composer`

Browse avaliable plugins at https://wpackagist.org/
install with command
```bash
composer require "wpackagist-plugin/*plugin-name*":"*version*"
```
If the plugin you want to use isn't on wpackagist don't worry you can add the dependency manually.
Add the plugin to the respositories array within the composer.json file
```
  "repositories": [
   ...
    {
      "type": "package",
      "package": {
        "name": "*author*/*plugin-name*",
        "version": "*version*",
        "type": "wordpress-plugin",
        "dist": {
          "type": "zip",
          "url": "https://downloads.wordpress.org/plugin/*plugin-name*.*version*.zip"
        },
        "require": {
          "composer/installers": "^1.0"
        }
      }
    }
   ...
  ],
```
Now require your plugin
```bash
composer require "*author*/*plugin-name*":"*"
```
### Assets
Within the theme the source assets are in the `assets` folder, are compile to the `dist` folder.
the `dist` folder is ignored by git so that package assets aren't needlessly store in the repo and it allows the assets to be minified on the production environment.

To compile the `assets` to `dist`, run:
```bash
yarn run dev
```
or you can run
```bash
yarn run watch
```
This will watch the files in the `assets` folder and recompile as you edit them

For the production environment run:
```bash
yarn run production
```
This will compile the assets and minify them ready for production

#### Packages
If you require outside packages please add them via `yarn`
Find the package in yarn's repository https://yarnpkg.com/en/
install with the command
```bash
yarn add *package-name*
```
These can be included in the the `js` and `scss` files within `assets`
```js
require('*package-name*');
```
```scss
@import "*package-name/path/to/css-or-scss*";
```
#### JS functions
Note that the asset compilation uses webpack so if you want to define a global variable or function you need to define them like this
```js
window.variable_name = some_value;
window.function_name = function () {
  // Code goes here...
};
```
# dev
