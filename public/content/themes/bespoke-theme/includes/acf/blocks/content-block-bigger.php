<?php
/**
 * Content-block-bigger
 */

return [
  'key' => 'mega_layout_content-block-bigger',
  'name' => 'content-block-bigger',
  'label' => 'Content block bigger',
  'display' => 'block',

  'sub_fields' => [

    [
     'key' => 'mega_layout_content-block-bigger_choose_side',
     'label' => 'Choose your image side',
     'name' => 'choose_side',
     'type' => 'radio',
     'choices' => [
        '' => 'Left',
        'order-2'=> 'Right',
      ],
    ],

    [
     'key' => 'mega_layout_content-block-bigger_pick_background',
     'label' => 'Pick a background',
     'name' => 'choose_background',
     'type' => 'radio',
     'choices' => [
        '' => 'White',
        'grey-background'=> 'Light Grey',
      ],
    ],

    [
      'key' => 'mega_layout_content-block-bigger_file',
      'label' => 'Image / Video',
      'name' => 'file',
      'type' => 'file',
      'required' => true,
      'mime_types' => 'mp4,jpeg,jpg,png',
      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_content-block-bigger_content',
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
