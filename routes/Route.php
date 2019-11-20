<?php
require_once ROOT . '/controller/ArticleController.php';

class Route
{
    private $controller;

    public function __construct()
    {
        $this->controller = new ArticleController();
    }

    public function run()
    {
        switch(URI) {
            case '/':
                $this->controller->index();
                break;
            case '/article?id=' . $_GET['id']:
                $this->controller->getArticle($_GET['id']);
                break;
            default:
                $this->controller->error(404);
                break;
        }
    }
}