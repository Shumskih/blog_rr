<?php


class Connection
{
    private $dbSettings;

    public function getDbSettings(): array
    {
        $this->dbSettings = parse_ini_file(ROOT . '/config/database.ini');

        return $this->dbSettings;
    }
}