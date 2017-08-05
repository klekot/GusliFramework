<?php
/**
 *
 */

use \GF\Core\Application as Application;

require_once '../config/bootstrap.php';

$app = new Application('development');
$app->run();
