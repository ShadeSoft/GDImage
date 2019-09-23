<?php

namespace ShadeSoft\GDImage;

use ShadeSoft\GDImage\Exception\FileException;
use ShadeSoft\GDImage\Exception\FileInvalidTypeException;
use ShadeSoft\GDImage\Helper\File;
use ShadeSoft\GDImage\Helper\Options;

class Converter
{
    protected $img;
    protected $format;
    protected $path;
    protected $quality;
    protected $originalFormat;

    /**
     * Resolve magic calls to set output format
     * @param string $method
     * @param array $args - First argument is quality percent as integer
     * @return self
     * @throws FileInvalidTypeException
     */
    public function __call($method, $args)
    {
        $availableFormats = File::FORMATS;

        if (strpos($method, 'to') === 0) {
            $format = lcfirst(substr($method, 2));

            if (!isset($availableFormats[$format])) {
                throw new FileInvalidTypeException('Not supported image type.');
            }

            $this->format = $availableFormats[$format];

            if (isset($args[0]) && $args[0] != null) {
                $this->quality($args[0]);
            }

            return $this;
        }
    }

    /**
     * Set source image for conversion
     * @param string|resource $image
     * @return self
     * @throws FileException
     */
    public function image($image)
    {
        $this->img = gettype($image) == 'resource' ? $image : File::get($image);

        if (gettype($image) == 'string') {
            $this->path   = $image;
            $this->format = $this->originalFormat = File::getType($image);
        }

        return $this;
    }

    /**
     * Set target path
     * @param string $path
     * @return self
     */
    public function target($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Set output quality
     * @param int $quality
     * @return self
     */
    public function quality($quality)
    {
        $this->quality = $quality;
        return $this;
    }

    /**
     * Set transparency
     */
    public function transparent() {
        $this->transparency($this->img);
    }

    /**
     * Save generated image
     * @return string
     */
    public function save()
    {
        File::save($this->path, $this->img, $this->format, $this->quality);

        return $this->path;
    }

    /**
     * Copy transparency if present
     * @param resource $img
     */
    protected function transparency($img)
    {
        if (in_array($this->originalFormat, [File::PNG, File::GIF, File::WEBP])) {
            Options::transparency($img, $this->img);
        }
    }
}
