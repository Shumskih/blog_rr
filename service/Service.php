<?php


abstract class Service
{
    abstract function getAll();

    abstract function getById($id): Article;
}