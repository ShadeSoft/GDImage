<?php

namespace ShadeSoft\GDImage;

use ShadeSoft\GDImage\Exception\FileException;
use ShadeSoft\GDImage\Exception\FileInvalidTypeException;
use ShadeSoft\GDImage\Helper\File;

class Converter
{
    private $img;
    private $format;
    private $path;
    private $quality;

    /**
     * Resolve magic calls to set output format
     * @param string $method
     * @param array $args - First argument is quality percent as integer
     * @return self
     * @throws FileInvalidTypeException
     */
    public function __call($method, $args)
    {
        if (strpos($method, 'to') == 0) {
            $format = lcfirst(substr($method, 2));

            if (!isset(File::FORMATS[$format])) {
                throw new FileInvalidTypeException('Not supported image type.');
            }

            $this->format = File::FORMATS[$format];

            if (isset($args[0]) && $args[0] != null) {
                $this->quality($args[0]);
            }

            return $this;
        }
    }

    /**
     * Set source image for conversion
     * @param string|resource $path
     * @return self
     * @throws FileException
     */
    public function image($image)
    {
        $this->img = gettype($image) == 'resource' ? $image : File::get($image);
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
     * Save generated image
     * @return string
     */
    public function save()
    {
        File::save($this->path, $this->img, $this->format, $this->quality);

        return $this->path;
    }
}