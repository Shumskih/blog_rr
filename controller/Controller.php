<?php


class Controller
{
    public function error($httpCode)
    {
        switch($httpCode) {
            case 404:
                include ROOT . '/view/errors/404.html.php';
                break;
            default:
                include ROOT . '/view/errors/default.html.php';
                break;
        }
    }
}