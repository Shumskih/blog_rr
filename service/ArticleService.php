<?php
require_once ROOT . '/storage/content/ArticleContent.php';
require_once ROOT . '/model/Article.php';

class ArticleService
{
    public function getAll(): array
    {
        return ArticleContent::ARTICLES;
    }

    public function getById($id): Article
    {
        $article = new Article();

        foreach (ArticleContent::ARTICLES as $a) {
            if ($a['id'] == $id) {
                $article->setId($a['id']);
                $article->setTitle($a['title']);
                $article->setDate($a['date']);
                $article->setPreview($a['preview']);
                $article->setText($a['text']);
            }
        }
        return $article;
    }
}