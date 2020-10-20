<?php

if (!function_exists('getStoragePath'))
{
    function getStoragePath()
    {
        return __DIR__ . "/../storage";
    }
}