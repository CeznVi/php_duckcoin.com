<?php
    session_start([
        'cookie_lifetime' => 86400,
    ]);

    require_once 'config.php';
    require_once 'functions.php';


    if (DEVELOP_MODE == true) {
        error_reporting(E_ALL); // отображать все
    } else {
        error_reporting(0); //не отображать ошибки
    }

    try {
        \App\Kernel::Init();
    } catch (Exception $e) {
            //логгирование ошибок!!!!!!! не показывать пользователю!!!!!!!!!
    }
