# GDImage

> An image editing package using PHP's GD library if other solutions fail for some reason.

[![Latest Stable Version](https://poser.pugx.org/shadesoft/gd-image/version)](https://packagist.org/packages/shadesoft/gd-image)
[![Build Status](https://travis-ci.org/ShadeSoft/GDImage.svg?branch=master)](https://travis-ci.org/ShadeSoft/GDImage)
[![Total Downloads](https://poser.pugx.org/shadesoft/gd-image/downloads)](https://packagist.org/packages/shadesoft/gd-image)
[![License](https://poser.pugx.org/shadesoft/gd-image/license)](https://packagist.org/packages/shadesoft/gd-image)

## Installation

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require shadesoft/gd-image
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

## Usage

```php
<?php
  // ...
  use ShadeSoft\GDImage\Service\ImageSizer;
  // ...
  class Demo {
    public function demo() {
      $img = 'path/to/image.jpg';

      $sizer = new ImageSizer;
      $sizer->thumbnail($img, 400, 300);
    }
  }
```
## Parameters

- $img: path to image file
- $width | $height | $maxWidth | $maxHeight: dimenstions of the desired image
- $outputFormat: null | "jpeg" | "jpg" | "png" | "gif" | "wbmp" | "bmp" | "webp" - if null, it won't change
- $targetPath: null | string - if null, $img will be used

## Available functions

- `void widen($img, $width [, $outputFormat] [, $targetPath]])`

  Set an image to the given width while preserving its ratio

- `void heighten($img, $height [, $outputFormat] [, $targetPath]])`

  Set an image to the given height while preserving its ratio

- `void maximize($img, $maxWidth, $maxHeight [, $outputFormat] [, $targetPath]])`

  Maximize image's size by its longest dimension while preserving its ratio

- `void thumbnail($img, $width, $height, [, $outputFormat] [, $targetPath]])`

  Make a thumbnail by cropping the image by its shortest dimension
