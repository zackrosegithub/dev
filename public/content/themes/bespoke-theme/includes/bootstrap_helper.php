<?php

class BootstrapHelper
{

  public static $grid_max_breakpoints = [
    // Extra small screen / phone
    'xs' => 575,
    // Small screen / phone
    'sm' => 767,
    // Medium screen / tablet
    'md' => 991,
    // Large screen / desktop
    'lg' => 1199,
    // Extra large screen / wide desktop
    'xl' => 1399,
    // Huge screen / widest desktop
    'hg' => 2100,

    'gt' => 2800,
  ];

  public static function images_srcset($image, array $image_sizes = array())
  {
    if(!is_array($image) && is_numeric($image))
    {
      $image = array_merge((array) get_post($image), wp_get_attachment_metadata($image));
    }

    uksort($image_sizes, function ($a, $b) {
      if(!isset(static::$grid_max_breakpoints[$a]) || !isset(static::$grid_max_breakpoints[$b]))
      {
        throw new Exception("Unknown media Breakpoint");
      }


      return static::$grid_max_breakpoints[$a] - static::$grid_max_breakpoints[$b];
    });

    $srcset = [];
    $sizes = [];

    if(count($image_sizes) <= 0)
    {
      throw new Exception("No sizes defined");
    }

    foreach($image_sizes as $breakpoint => $image_size)
    {
      if(!isset($image['sizes'][$image_size]))
      {
        throw new Exception("Unknown image size");
      }

      $srcset[] = $image['sizes'][$image_size] . ' ' . $image['sizes'][$image_size . '-width'] . 'w';
      $sizes[] = '(max-width: ' . static::$grid_max_breakpoints[$breakpoint] . 'px) ' . $image['sizes'][$image_size . '-width'] . 'px';
    }

    $largest = end($image_sizes);

    array_pop($sizes);

    $sizes[] = $image['sizes'][$image_size . '-width'] . 'px';

    return ' srcset="' . esc_attr(implode(', ', $srcset)) . '" sizes="' . esc_attr(implode(', ', $sizes)) . '" src="' . esc_attr($image['sizes'][$largest]) . '" ';
  }

  public static function picture($image, array $image_sizes = array(), $options = array())
  {
    if(!is_array($image) && is_numeric($image))
    {
      $image = array_merge((array) get_post($image), wp_get_attachment_metadata($image));
    }

    uksort($image_sizes, function ($a, $b) {
      if(!isset(static::$grid_max_breakpoints[$a]) || !isset(static::$grid_max_breakpoints[$b]))
      {
        throw new Exception("Unknown media Breakpoint");
      }


      return static::$grid_max_breakpoints[$a] - static::$grid_max_breakpoints[$b];
    });

    if(count($image_sizes) <= 0)
    {
      throw new Exception("No sizes defined");
    }

    $largest = array_pop($image_sizes);

    $attributes = "";

    if(isset($options['class']))
    {
      $attributes .= ' class="' . esc_attr($options['class']) . '"';
    }

    ob_start();
    ?>
    <picture <?php echo $attributes ?>>
      <?php foreach($image_sizes as $breakpoint => $image_size): ?>

        <source media="(max-width: <?php esc_attr_e(static::$grid_max_breakpoints[$breakpoint]) ?>px)" srcset="<?php esc_attr_e($image['sizes'][$image_size]) ?>">
      <?php endforeach; ?>

      <img src="<?php esc_attr_e($image['sizes'][$largest]) ?>" alt="<?php esc_attr_e($image['name']) ?>">
    </picture>
    <?php
    return ob_get_clean();
  }

}
