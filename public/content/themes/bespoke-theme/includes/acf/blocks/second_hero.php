<?php
/**
 * second_Hero Block
 */

return [
  'key' => 'mega_layout_second_hero',
  'name' => 'second_hero',
  'label' => 'Second Hero',
  'display' => 'block',

  'sub_fields' => [
    [
      'key' => 'mega_layout_second_hero_file',
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
      'key' => 'mega_layout_second_hero_video_placeholder',
      'label' => 'Video Placeholder',
      'name' => 'video_placeholder',
      'type' => 'image',
      'instructions' => 'If video is used this image will be used before the image loads',

      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_second_hero_content',
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