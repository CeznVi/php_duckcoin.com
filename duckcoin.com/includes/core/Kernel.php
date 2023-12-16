<?php

namespace App;

class Kernel
{
    public  static $router;

    public static function Init() {
        self::$router = new Router();
        self::$router->Start();
    }
}