<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 06.08.17
 * Time: 10:40
 */

namespace GF\Core;

class DbConnection
{
    public $environment;

    public function __construct($environment)
    {
        $this->environment = $environment;

        if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
            die('PHP ActiveRecord requires PHP 5.3 or higher');

        \ActiveRecord\Config::initialize(function ($cfg) {
            $cfg->set_model_directory(MODELS);
            $cfg->set_connections(array(
                $this->environment => DB_ADAPTER . "://"
                    . DB_USER . ":"
                    . DB_PASS . "@"
                    . DB_HOST . "/"
                    . DB_BASE
            ));
            //$cfg->set_date_format("Y-m-d H:i:s");
        });
    }
}