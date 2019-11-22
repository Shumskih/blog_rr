<?php
require_once ROOT . '/controller/Controller.php';
require_once ROOT . '/service/ArticleArrayService.php';
require_once ROOT . '/routes/Route.php';

class ArticleController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new ArticleArrayService();
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

        if (!$article->getId()) {
           $this->error(404);
        }
        if ($article->getId()) {
            $title = $article->getTitle();

            include ROOT . '/view/article.html.php';
        }
    }
}