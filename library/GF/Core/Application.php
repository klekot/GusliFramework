<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 14.07.17
 * Time: 22:35
 */

namespace GF\Core;

use GF\Utils\Utils as Utils;

class Application
{
    public function __construct($environment)
    {
        // Load special environments settings from environments.yml
        Utils::loadYaml(dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'environments.yml',
            $environment);

        // Load DB connection settings
        Utils::loadYaml(dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . 'connections.yml',
            $environment);
    }

    public function run()
    {
        $query = rtrim($_SERVER['QUERY_STRING'], '/');

        Router::dispatch($query);
    }
}