<?php


namespace Dimolina;


class ImageResizeDecorator extends ImageDecorator
{
    protected $width;
    protected $height;

    /**
     * ImageResizeDecorator constructor.
     * @param Drawable $image
     * @param $width
     * @param $height
     */
    public function __construct(Drawable $image, $width, $height)
    {
        parent::__construct($image);
        $this->width = $width;
        $this->height = $height;
    }

    public function draw()
    {
        return imagescale($this->image->draw(), $this->width, $this->height);
    }
}