<?php


namespace Dimolina\Tests;


use Dimolina\ImageFromPng;
use Dimolina\ImageFromJpeg;
use Dimolina\ImageResizeDecorator;
use Dimolina\ImageGrayScaleDecorator;
use Dimolina\ImageAddFilterDecorator;
use Dimolina\ImageWithBorderDecorator;


class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function checkIfImageIsCreated()
    {
        $image = new ImageFromJpeg(getAssetPath('img.jpeg'));

        $fileName = 'img-copy.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageIsResized()
    {
        $image = new ImageFromJpeg(getAssetPath('img.jpeg'));
        $image = new ImageResizeDecorator($image,500, 800);

        $fileName = 'img-copy-resized.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageInGrayScale()
    {
        $image = new ImageFromJpeg(getAssetPath('img.jpeg'));
        $image = new ImageGrayScaleDecorator($image);

        $fileName = 'img-gray-scale.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageWithBorder()
    {
        $image = new ImageFromJpeg(getAssetPath('img.jpeg'));
        $image = new ImageWithBorderDecorator($image, 30);

        $fileName = 'img-with-border.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageResizedInGrayScaleWithBorder()
    {
        $image = ImageFromJpeg::make(getAssetPath('img.jpeg'));
        $image = new ImageResizeDecorator($image,500, 800);
        $image = new ImageGrayScaleDecorator($image);
        $image = new ImageWithBorderDecorator($image, 30);

        $fileName = 'img-resized-in-grayscale-with-border.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function checkIfImageIsCreatedFromPng()
    {
        $image = new ImageFromPng(getAssetPath('cat.png'));

        $fileName = 'img-copy.png';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImagePngIsResized()
    {
        $image = new ImageFromPng(getAssetPath('cat.png'));
        $image = new ImageResizeDecorator($image,500, 800);

        $fileName = 'img-copy-resized.png';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImagePngInGrayScale()
    {
        $image = new ImageFromPng(getAssetPath('cat.png'));
        $image = new ImageGrayScaleDecorator($image);

        $fileName = 'img-gray-scale.png';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImagePngWithFilter()
    {
        $image = new ImageFromPng(getAssetPath('cat.png'));
        $imageFilter = new ImageFromPng(getAssetPath('filter.png'));

        $image = new ImageAddFilterDecorator($image, $imageFilter);

        $fileName = 'img-with-filter.png';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    public function assertSnapShootImageEquals($fileName, $image)
    {
        if (!file_exists(getStoragePath($fileName))) {
            $this->createImageByMimeType($image, getStoragePath($fileName));
            $this->markTestIncomplete("The snapshot image doesn't exists");
        }

        $this->createImageByMimeType($image, $this->getSnapShotPath($fileName));

        $this->assertTrue(file_get_contents(getStoragePath($fileName)) === file_get_contents($this->getSnapShotPath($fileName)),
            "The image {$fileName} does not match with the expected {$fileName}.");
    }

    protected function createImageByMimeType($image, $path)
    {
        $imageResource = $image;
        if (is_subclass_of($imageResource, 'Dimolina\ImageDecorator')) {
            while (method_exists($imageResource,'getImage')) {
                $imageResource = $imageResource->getImage();
            }
        }

        switch (exif_imagetype($imageResource->getPath()))
        {
            case IMAGETYPE_PNG:
                imagepng($image->draw(), $path);
                break;
            default:
                imagejpeg($image->draw(), $path);
                break;
        }
    }

    protected function getSnapShotPath($fileName)
    {
        return __DIR__ . '/snapshot/'. $fileName;
    }
}