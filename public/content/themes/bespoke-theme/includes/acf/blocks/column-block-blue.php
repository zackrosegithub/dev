<?php
/**
 * column-block-blue
 */

return [
  'key' => 'mega_layout_column-block-blue',
  'name' => 'column-block-blue',
  'label' => 'Column Block Blue',
  'display' => 'block',

  'sub_fields' => [

    [
      'key' => 'mega_layout_column-block-blue_title',
      'label' => 'Title',
      'name' => 'title',
      'type' => 'wysiwyg',
      'required' => false,
      'media_upload' => false,
    ],

    [
      'key' => 'mega_layout_column-block-blue-repeater',
      'name' => 'column-block-blue-repeater',
      'label' => 'Column Block Blue Repeater',
      'display' => 'block',
      'type' => 'repeater',

      'sub_fields' => [

      [
        'key' => 'mega_layout_column-block-blue_content',
        'label' => 'Content',
        'name' => 'content',
        'type' => 'wysiwyg',
        'required' => false,
        ],
      ],
    ],
  ],

  'min' => '',
  'max' => '',
];
