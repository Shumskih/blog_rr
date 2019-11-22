<?php


abstract class Service
{
    abstract function getAll(): array;

    abstract function getById($id): Article;
}