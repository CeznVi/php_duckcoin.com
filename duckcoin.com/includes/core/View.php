<?php


namespace App;


class View
{
    public static function render (
                                    $contentView = '',
                                    $data = null,
                                    $templateView = VIEWS_PATH.'templateView'.EXT
    ) {
        require $templateView;
    }
}