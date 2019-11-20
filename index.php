<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/consts.php';
require_once ROOT . '/routes/Route.php';

$route = new Route();
$route->run();

exit;