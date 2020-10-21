<?php

if (!function_exists('getStoragePath'))
{
    function getStoragePath($path)
    {
        return __DIR__ . '/../storage/' . $path;
    }
}

if (!function_exists('getAssetPath'))
{
    function getAssetPath($path)
    {
        return __DIR__ . '/../assets/' . $path;
    }
}