<?php
/**
 * call-to-action Block
 */

return [
  'key' => 'mega_layout_call-to-action',
  'name' => 'call-to-action',
  'label' => 'Call To Action',
  'display' => 'block',

  'sub_fields' => [
    [
      'key' => 'mega_layout_call-to-action_image',
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
      'key' => 'mega_layout_call-to-action_content',
      'label' => 'Content',
      'name' => 'content',
      'type' => 'wysiwyg',
      'required' => false,
      'media_upload' => false,
    ],
  ],

  'min' => '',
  'max' => '',
];