<?php
/**
 *
 */

use GF\Utils\Utils as Utils;

define('ROOT', dirname(__DIR__));

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'GF' . DIRECTORY_SEPARATOR . 'Utils' . DIRECTORY_SEPARATOR . 'Utils.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'GF' . DIRECTORY_SEPARATOR . 'Core'  . DIRECTORY_SEPARATOR . 'AutoLoader.php';

// Define app default constants from settings.yml
Utils::loadYaml(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.yml');

AutoLoader::load();

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . CONFIG . DIRECTORY_SEPARATOR . 'routes.php';