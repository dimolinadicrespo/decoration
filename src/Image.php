<?php


namespace Dimolina;


abstract class Image implements Drawable
{
    protected $path;

    /**
     * ImageFromJpeg constructor.
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }
}