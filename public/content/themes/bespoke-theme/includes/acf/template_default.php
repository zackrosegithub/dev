<?php
acf_add_local_field_group([
  'key' => 'template_default',
  'title' => 'Default Page',
  'style' => 'seamless',

  'location' => [
    [
      [
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => '',
      ]
    ],

    [
      [
        'param'    => 'page_template',
        'operator' => '==',
        'value'    => 'default',
      ]
    ],
  ],

  'hide_on_screen' => ['the_content'],

  'fields' => [

    [
      'key' => 'template_default_flexible_content',
      'type' => 'clone',
      'clone' => [
        'flexible_content_group',
      ],
    ],

  ],
]);
