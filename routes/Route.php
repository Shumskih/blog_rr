<?php
require_once ROOT . '/controller/ArticleController.php';
require_once ROOT . '/sql/migrations/CreateDatabaseMigration.php';
require_once ROOT . '/sql/migrations/PopulateDatabaseMigration.php';

class Route
{
    private $controller;

    public function __construct()
    {
        $this->controller = new ArticleController();
    }

    public function run()
    {
        switch (URI) {
            case '/':
                $this->controller->index();
                break;
            case self::getArticle():
                $this->controller->article($_GET['id']);
                break;
            case '/migrate':
                $c = new CreateDatabaseMigration();
                $c->run();
                $p = new PopulateDatabaseMigration();
                $p->run();
                break;
            default:
                $this->controller->error(404);
                break;
        }
    }

    private static function getArticle()
    {
        if (isset($_GET['id'])) return '/article?id=' . $_GET['id'];
    }
}