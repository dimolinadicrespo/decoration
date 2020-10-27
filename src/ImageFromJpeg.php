<?php

namespace Dimolina;

class ImageFromJpeg extends Image
{
    public static function make($path, $width = null, $height = null, $grayscale = false, $border = false)
    {
        $image = new static($path);

        if ($width && $height) {
            $image =  new ImageResizeDecorator($image, $width, $height);
        }
        if ($grayscale) {
            $image =  new ImageGrayScaleDecorator($image);
        }
        if ($border) {
            $image =  new ImageWithBorderDecorator($image, $border);
        }

        return $image;
    }

    public function draw()
    {
        return imagecreatefromjpeg($this->path);
    }
}