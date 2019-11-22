<?php
require_once ROOT . 'service/Service.php';
require_once ROOT . '/model/Article.php';
require_once ROOT . 'helpers/DbConnection.php';
require_once ROOT . '/sql/SqlQuery.php';

class ArticleMySqlService extends Service
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DbConnection::getConnection();
    }

    function getAll(): array
    {
        try {
            $this->pdo->beginTransaction();

            $query = SqlQuery::SELECT_ALL_ARTICLES;
            $stmt = $this->pdo->query($query);
            $array = $stmt->fetchAll();

            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo 'Can\'t get all articles<br>' . $e->getMessage();
        }
        return $array;
    }

    function getById($id): Article
    {
        try {
            $this->pdo->beginTransaction();

            $query = SqlQuery::SELECT_ARTICLE;
            $stmt  = $this->pdo->prepare($query);
            $stmt->execute([
                'id' => $id,
            ]);
            $article = $stmt->fetch();

            $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo 'Can\'t get article from database<br>' .
                $e->getFile() . ': line ' . $e->getLine() . '<br>' . $e->getMessage();
        }

        return $this->bindArticle($article);
    }

    private function bindArticle($array)
    {
        $article = new Article();
        $article->setId($array['id']);
        $article->setTitle($array['title']);
        $article->setDate(date("d.m.Y", $array['date']));
        $article->setPreview($array['preview']);
        $article->setText($array['text']);

        return $article;
    }

}