<?php

namespace App\src\controller;

class ErrorController extends Controller
{
    public function errorNotFound()
    {
        require './templates/error_404.php';
    }

    public function errorServer($e)
    {
        $message = $e->getMessage();
        require './templates/error_500.php';
    }
}
