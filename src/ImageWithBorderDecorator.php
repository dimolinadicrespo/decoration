<?php


namespace Dimolina;


class ImageWithBorderDecorator extends ImageDecorator
{
    protected $border;

    /**
     * ImageWithBorderDecorator constructor.
     * @param Drawable $image
     * @param $border
     */
    public function __construct(Drawable $image, $border = 5)
    {
        parent::__construct($image);
        $this->border = $border;
    }

    public function draw()
    {
        $img = $this->image->draw();

        $this->addBorder($img);

        return $img;
    }

    public function addBorder($img): void
    {
        for ($i = 0; $i < $this->border; $i++) {
            imagerectangle($img, $i, $i, imagesx($img) - $i - 1, imagesy($img) - $i - 1,
                imagecolorallocate($img, 0, 0, 0));
        }
    }
}