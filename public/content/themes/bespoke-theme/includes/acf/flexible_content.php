<?php

$layouts = [];

foreach( glob(__DIR__ . '/blocks/*.php') as $filename )
{
  $name = basename($filename);
  $name = explode('.', $name);

  $layouts [ reset($name) ] = include( $filename );
}

acf_add_local_field_group([
  'key' => 'flexible_content_group',
  'title' => 'Mega',

  'fields' => [
    [
      'key' => 'mega_flexible_content',
      'label' => 'Flexible Content',
      'name' => 'flexible_content',
      'type' => 'flexible_content',

      'layouts' => $layouts,

      'button_label' => 'Add',
      'min' => '',
      'max' => '',
    ]
  ],
]);
