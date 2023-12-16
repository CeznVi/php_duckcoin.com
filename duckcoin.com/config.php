<?php

    const DEVELOP_MODE = true;

    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'myDB';

    const ABS_PATH = __DIR__;
    const SEP = '/';
    const EXT = '.php';

    const INC_PATH = ABS_PATH.SEP."includes".SEP;
    const CORE_PATH = INC_PATH.'core'.SEP;
    const MODELS_PATH = INC_PATH.'models'.SEP;
    const CONTROLLERS_PATH = INC_PATH.'controllers'.SEP;

    const VIEWS_PATH = INC_PATH.'views'.SEP;
    const PAGES_PATH = VIEWS_PATH.'pages'.SEP;

    function autoloadCoreClass($className) {

        $directorys = array(
            CORE_PATH,
            MODELS_PATH,
            CONTROLLERS_PATH
        );
        foreach ($directorys as $dir) {
            $parts = explode('\\', $className);
            if(file_exists($dir.end($parts).EXT)) {
                require_once $dir.end($parts).EXT;
                return;
           }
        }
    }

    spl_autoload_register('autoloadCoreClass');

