<?php
/**
 * Contact- Hero Block
 */

return [
  'key' => 'mega_layout_contact_hero',
  'name' => 'contact-hero',
  'label' => 'Contact Hero',
  'display' => 'block',

  'sub_fields' => [
    [
      'key' => 'mega_layout_contact_hero_background_image',
      'label' => 'Background Image',
      'name' => 'background_image',
      'type' => 'image',
      'required' => true,
      'mime_types' => 'jpeg,jpg,png',
      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_contact_hero_foreground_image',
      'label' => 'Foreground Image',
      'name' => 'foreground_image',
      'type' => 'image',
      'required' => true,
      'mime_types' => 'jpeg,jpg,png',
      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_contact_hero_content',
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
