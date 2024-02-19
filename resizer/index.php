<?php
require_once './model/Image.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tmp = "tmp/images.zip";

  $zip = new ZipArchive();
  $zip->open("tmp/images.zip", ZipArchive::CREATE);

  $options = (object)[
    "desktop" => (object)[
      "width" => $_POST["desktop_width"],
      "height" => $_POST["desktop_height"],
      "quality" => $_POST["desktop_quality"]
    ],
    "mobile" => (object)[
      "width" => $_POST["mobile_width"],
      "height" => $_POST["mobile_height"],
      "quality" => $_POST["mobile_quality"]
    ]
  ];

  foreach ($_FILES['images']['tmp_name'] as $key => $tmp) {
    $image = new Image($tmp);
    $image_name = Image::gen_slug($_FILES['images']['name'][$key]);

    $zip->addFromString("desktop/$image_name.webp", $image->create_image($options->desktop));
    $zip->addFromString("mobile/$image_name.webp", $image->create_image($options->mobile));
  }

  $zip->close();

  header("Content-Type: application/zip");

  readfile("tmp/images.zip");
  unlink("tmp/images.zip");
}
