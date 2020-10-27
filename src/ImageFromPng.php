<?php


namespace Dimolina;


class ImageFromPng extends Image
{
    public function draw()
    {
         return imagecreatefrompng($this->path);
    }
}