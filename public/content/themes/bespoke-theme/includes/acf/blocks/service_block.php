<?php
/**
 * service_block Block
 */

return [
  'key' => 'mega_layout_service_block',
  'name' => 'service_block',
  'label' => 'Service Block',
  'display' => 'block',

  'sub_fields' => [
    [
      'key' => 'mega_layout_service_block_content',
      'label' => 'Left hand text',
      'name' => 'content',
      'type' => 'wysiwyg',
      'required' => false,
      'media_upload' => false,
      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_service_block_image',
      'label' => 'Image',
      'name' => 'image',
      'type' => 'image',
      'required' => true,
      'mime_types' => 'jpeg,jpg,png',
      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_service_block_repeater',
      'label' => 'Panels',
      'name' => 'panels_repeater',
      'type' => 'repeater',
      'wrapper' => [
        'width' => '50%',
      ],

      'sub_fields' => [
        [
          'key' => 'mega_layout_service_block_panel_text',
          'label' => 'Left hand text',
          'name' => 'panels',
          'type' => 'wysiwyg',
      ],

    ],
  ],


  ],

  'min' => '',
  'max' => '',
];