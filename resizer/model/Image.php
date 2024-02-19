<?php

class Image
{
  public $image;

  function __construct($image)
  {
    $this->image = $image;
  }

  public function create_image($options)
  {
    list($width, $height) = $this->get_new_size($options);

    list($original_width, $original_height) = getimagesize($this->image);

    $original_image = imagecreatefromstring(file_get_contents($this->image));
    $resized_image = imagecreatetruecolor($width, $height);
    imagealphablending($resized_image, false);
    imagesavealpha($resized_image, true);

    $transparencyColor = imagecolorallocatealpha($resized_image, 0, 0, 0, 127);
    imagefill($resized_image, 0, 0, $transparencyColor);


    imagecopyresampled(
      $resized_image,
      $original_image,
      0,
      0,
      0,
      0,
      $width,
      $height,
      $original_width,
      $original_height
    );
    ob_start();
    imagewebp($resized_image, null, (int)$options->quality ?: 80);
    return ob_get_clean();
  }

  public function get_new_size($options)
  {
    list($width, $height) = getimagesize($this->image);

    $aspect = $width / $height;

    if ($options->width && !$options->height) {
      $width = $options->width;
      $height = round($options->width / $aspect);
    } else if ($options->height && !$options->width) {
      $width = round($options->height * $aspect);
      $height = $options->height;
    }

    return [$width, $height];
  }

  public static function gen_slug($text)
  {
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $slug = str_replace(' ', '-', $slug);
    $slug = preg_replace('/\.[^.]+$/', '', $slug);
    $slug = strtolower($slug);

    return $slug;
  }
};
