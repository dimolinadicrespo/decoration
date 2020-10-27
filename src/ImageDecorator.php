<?php


namespace Dimolina;


abstract class ImageDecorator implements Drawable
{
    protected Drawable $image;

    public function __construct(Drawable $image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
}