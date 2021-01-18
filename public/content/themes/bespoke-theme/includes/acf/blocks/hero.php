<?php
/**
 * Hero Block
 */

return [
  'key' => 'mega_layout_hero',
  'name' => 'hero',
  'label' => 'Hero',
  'display' => 'block',

  'sub_fields' => [
    [
      'key' => 'mega_layout_hero_file',
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
      'key'=>'mega_layout_hero_repeater',
      'name'=>'foreground_image',
      'label'=>'Hero Repeater',
      'type'=>'repeater',
      'layout' => 'block',

        'sub_fields' => [



              [
                'key' => 'mega_layout_hero_foreground_image',
                'label' => 'Foreground Image',
                'name' => 'foreground_image_image',
                'type' => 'image',
                'required' => true,
                'mime_types' => 'jpeg,jpg,png',
                'wrapper' => [
                  'width' => '50%',
                ],
              ],

    ],
  ],





    [
      'key' => 'mega_layout_hero_video_placeholder',
      'label' => 'Video Placeholder',
      'name' => 'video_placeholder',
      'type' => 'image',
      'instructions' => 'If video is used this image will be used before the image loads',

      'wrapper' => [
        'width' => '50%',
      ],
    ],

    [
      'key' => 'mega_layout_hero_content',
      'label' => 'Content',
      'name' => 'content',
      'type' => 'wysiwyg',
      'required' => false,
      'media_upload' => false,
    ],

    [
      'key' => 'mega_layout_hero_links_repeater',
      'name' => 'links_repeater',
      'label' => 'Links',
      'display' => 'block',

      'sub_fields' => [

        [
          'key' => 'mega_layout_hero_link_repeater',
          'label' => 'Links',
          'name' => 'links',
          'type' => 'link',
        ],
      ],
    ],

  ],

  'min' => '',
  'max' => '',
];
