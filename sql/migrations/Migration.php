<?php


abstract class Migration
{
    abstract function run();

    public function getDbSettings(): array
    {
        return parse_ini_file(ROOT . '/config/database.ini');
    }
}