<?php

class SimpleImageLib{

    public function __construct()
    {
        require_once "vendor/autoload.php";
    }

    public function SimpleImageInit()
    {
        return new \claviska\SimpleImage();
    }
}