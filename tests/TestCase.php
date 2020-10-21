<?php


namespace Dimolina\Tests;


use Dimolina\Image;

class TestCase extends \PHPUnit\Framework\TestCase
{

    /** @test */
    public function checkIfImageIsCreated()
    {
        $image = new Image(getAssetPath('img.jpeg'));

        $fileName = 'img-copy.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageIsResized()
    {
        $image = new Image(getAssetPath('img.jpeg'),200, 300);

        $fileName = 'img-copy-resized.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageInGrayScale()
    {
        $image = new Image(getAssetPath('img.jpeg'),null, null, true);

        $fileName = 'img-gray-scale.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageWithBorder()
    {
        $image = new Image(getAssetPath('img.jpeg'),null, null, true, 20);

        $fileName = 'img-with-border.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    /** @test */
    public function assertImageResizedInGrayScaleWithBorder()
    {
        $image = new Image(getAssetPath('img.jpeg'),200, 300, true, 20);

        $fileName = 'img-resized-in-grayscale-with-border.jpeg';

        $this->assertSnapShootImageEquals($fileName, $image);
    }

    public function assertSnapShootImageEquals($fileName, $image)
    {
        if (!file_exists(getStoragePath($fileName))) {
            imagejpeg($image->draw(), getStoragePath($fileName));
            $this->markTestIncomplete("The snapshot image doesn't exists");
        }

        imagejpeg($image->draw(), $this->getSnapShotPath($fileName));

        $this->assertTrue(file_get_contents(getStoragePath($fileName)) === file_get_contents($this->getSnapShotPath($fileName)),
            "The image {$fileName} does not match with the expected {$fileName}.");
    }

    protected function getSnapShotPath($fileName)
    {
        return __DIR__ . '/snapshot/'. $fileName;
    }
}