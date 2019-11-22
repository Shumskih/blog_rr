<?php
require_once ROOT . '/helpers/MySqlConnection.php';
require_once ROOT . '/helpers/DbConnection.php';
require_once ROOT . '/sql/migrations/Migration.php';

class CreateDatabaseMigration extends Migration
{
    public function run()
    {
        $mySql = MySqlConnection::getConnection();
        $dbSettings = $this->getDbSettings();

        $this->createDB($mySql, $dbSettings);
        $this->createUser($mySql, $dbSettings);
        $this->grantPrivileges($mySql, $dbSettings);
        $this->flushPrivileges($mySql);

        $mySql = NULL;
    }

    private function createDB($pdo, $dbSettings): bool
    {
        try {
            $pdo->beginTransaction();
            $pdo->query("CREATE DATABASE IF NOT EXISTS {$dbSettings['db_name']}");
            $pdo->commit();
            $info = $pdo->errorInfo();
            print_r($info);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $e->getMessage();
            return false;
        }

        return true;
    }

    private function createUser($pdo, $dbSettings): bool
    {
        try {
            $pdo->beginTransaction();
            $pdo->query("CREATE USER IF NOT EXISTS '{$dbSettings['db_user']}'@'{$dbSettings['db_host']}' identified by '{$dbSettings['db_password']}'");
            $pdo->commit();
            $info = $pdo->errorInfo();
            print_r($info);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $e->getMessage();
            return false;
        }

        return true;
    }

    private function grantPrivileges($pdo, $dbSettings): bool
    {
        try {
            $pdo->beginTransaction();
            $pdo->query("GRANT ALL PRIVILEGES ON {$dbSettings['db_name']}.* TO '{$dbSettings['db_user']}'@'{$dbSettings['db_host']}'");
            $pdo->commit();
            $info = $pdo->errorInfo();
            print_r($info);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $e->getMessage();
            return false;
        }

        return true;
    }

    private function flushPrivileges($pdo): bool
    {
        try {
            $pdo->beginTransaction();
            $pdo->query("FLUSH PRIVILEGES");
            $pdo->commit();
            $info = $pdo->errorInfo();
            print_r($info);
        } catch (PDOException $e) {
            $pdo->rollBack();
            $e->getMessage();
            return false;
        }

        return true;
    }
}