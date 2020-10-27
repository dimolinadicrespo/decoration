<?php


namespace Dimolina;


class ImageAddFilterDecorator extends ImageDecorator
{
    protected Drawable $imageFilter;

    /**
     * ImageAddFilterDecorator constructor.
     * @param Drawable $image
     * @param Drawable $imageFilter
     */
    public function __construct(Drawable $image, Drawable $imageFilter)
    {
        parent::__construct($image);
        $this->imageFilter = $imageFilter;
    }

    public function draw()
    {
        $img = $this->image->draw();
        list($width, $height) = getimagesize($this->imageFilter->getPath());

        imagecopy($img, imagescale($this->imageFilter->draw(), $width , $height), 0 ,0  ,0  ,0, $width, $height);

        return $img;
    }

    /**
     * @return Drawable
     */
    public function getImage(): Drawable
    {
        return $this->image;
    }
}