<?php
require_once ROOT . '/controller/Controller.php';
require_once ROOT . '/service/ArticleService.php';

class ArticleController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new ArticleService();
    }

    public function index()
    {
        $title = 'All articles';
        $articles = $this->service->getAll();

        include ROOT . '/view/index.html.php';
    }

    public function article($id)
    {
        $article = $this->service->getById($id);

        include ROOT . '/view/article.html.php';
    }
}