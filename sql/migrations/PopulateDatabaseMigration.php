<?php


class PopulateDatabaseMigration extends Migration
{
    public function run()
    {
        $db = DbConnection::getConnection();
        $dbSettings = $this->getDbSettings();

        $this->createTable($db, $dbSettings);
        $this->populateArticleTable($db);
    }

    private function createTable($pdo, $dbSettings)
    {
        foreach ($dbSettings['db_tables'] as $table) {
            try {
                $pdo->beginTransaction();
                $pdo->query("CREATE TABLE IF NOT EXISTS $table (
                                        id      int unsigned not null auto_increment,
                                        title   varchar(255) not null,
                                        date    int          not null,
                                        preview text         not null,
                                        text    text         not null,
                                        primary key (id)
                                )
                                engine = innodb
                                auto_increment = 1
                                character set utf8
                                collate utf8_general_ci");
                $pdo->commit();
                $info = $pdo->errorInfo();
                print_r($info);
            } catch (PDOException $e) {
                $pdo->rollBack();
                $e->getMessage();
            }
        }
        $info = $pdo->errorInfo();
        print_r($info);
    }

    private function populateArticleTable($pdo)
    {
        foreach (ArticleContent::ARTICLE as $article) {
            $time = DateTime::createFromFormat("d.m.Y", $article['date']);
            $time = $time->getTimestamp();
            try {
                $pdo->beginTransaction();
                $query = 'INSERT INTO article VALUES (null, :title, :date, :preview, :text)';
                $res = $pdo->prepare($query);
                $res->execute([
                    'title' => $article['title'],
                    'date' => $time,
                    'preview' => $article['preview'],
                    'text' => $article['text'],
                ]);
                $pdo->commit();
            } catch (PDOException $e) {
                $pdo->rollBack();
                echo 'Can\'t populate article table<br>' . $e->getMessage();
            }
        }
    }
}