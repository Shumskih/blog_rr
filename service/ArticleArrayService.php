<?php
require_once ROOT . '/storage/content/ArticleContent.php';
require_once ROOT . '/model/Article.php';
require_once ROOT . '/service/Service.php';

class ArticleArrayService extends Service
{
    public function getAll(): array
    {
        return ArticleContent::ARTICLE;
    }

    public function getById($id): Article
    {
        $article = new Article();

        foreach (ArticleContent::ARTICLE as $a) {
            if ($a['id'] == $id) {
                $article->setId($a['id']);
                $article->setTitle($a['title']);
                $article->setDate(date("d.m.Y", $a['date']));
                $article->setPreview($a['preview']);
                $article->setText($a['text']);
            }
        }
        return $article;
    }
}