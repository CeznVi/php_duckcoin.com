<?php

namespace App;
class ErrorController extends Controller
{
    function Index()
    {
        View::render(
            PAGES_PATH.'error404'.EXT, $this->data
        );
    }
}