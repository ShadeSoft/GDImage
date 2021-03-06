# GDImage

> An image editing package using PHP's GD library if other solutions fail for some reason.

[![Latest Stable Version](https://poser.pugx.org/shadesoft/gd-image/version)](https://packagist.org/packages/shadesoft/gd-image)
[![Build Status](https://travis-ci.org/ShadeSoft/GDImage.svg?branch=master)](https://travis-ci.org/ShadeSoft/GDImage)
[![StyleCI](https://styleci.io/repos/109691251/shield?style=flat)](https://styleci.io/repos/109691251)
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

### ImageConverter

```php
<?php
  // ...
  use ShadeSoft\GDImage\Converter;
  // ...
  class Demo {
    public function demo() {
      $img = 'path/to/image.png';

      $converter = new Converter;
      $converter
        ->image($img)
        ->toJpg()
        ->target('path/to/converted-image.jpg')
        ->save();
    }
  }
```

#### Available functions

- `image ( string | resource $image ) : self`

  Set source image from file path or image resource

- `target ( string $path ) : self`

  Set target path

- `quality ( int quality ) : self`

  Set output quality - accepted value is a percentage

- `toBmp() | toGif() | toJpg() | toJpeg() | toPng() | toWebp() : self`

  Set output format

- `save() : string`

  Save generated image

### ImageSizer

```php
<?php
  // ...
  use ShadeSoft\GDImage\Sizer;
  // ...
  class Demo {
    public function demo() {
      $img = 'path/to/image.jpg';

      $sizer = new Sizer;
      $sizer
        ->image($img)
        ->thumbnail(400, 300)
        ->save();
    }
  }
```
#### Available functions

**See available functions at Converter, all of them are available here, too**

- `image ( string | resource $image ) : self`

  Set source image or return the stored instance

- `widen ( int $width ) : self`

  Set the image to the given width while preserving its ratio

- `heighten ( int $height ) : self`

  Set the image to the given height while preserving its ratio

- `maximize ( int $width, int $height ) : self`

  Maximize image's size by its longer dimension while preserving its ratio

- `crop ( int $width, int $height [, int $x [, int $y]] ) : self`

  Crop picture to given dimensions starting at the given position

- `thumbnail ( int $width, int $height ) : self`

  Make a thumbnail by cropping the image by its shorter dimension (centered crop)

- `output() : void`

  Print image to PHP output
