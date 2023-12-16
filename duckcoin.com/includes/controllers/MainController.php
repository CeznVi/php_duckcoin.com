<?php

namespace App;
class MainController extends Controller
{
    function Index()
    {

        View::render(
            PAGES_PATH.'main'.EXT, $this->data
        );


    }
}