<?php
/**
 *
 */

define('ROOT', dirname(__DIR__));

// Define app constants from settings.yaml
$sets = yaml_parse_file(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'settings.yml');

foreach ($sets as $set) {
    foreach ($set as $const => $value ) {
        if (is_array($value)) {
            foreach ($value as $const1 => $value1 ) {
                define($const1, $value1);
            }
            continue;
        }
        if ($const == 'APP') $app = $value;
        switch ($const) {
            case 'CACHE':
                $value = 'data' . DIRECTORY_SEPARATOR . $value;
                break;
            case 'GF':
                $value = 'library' . DIRECTORY_SEPARATOR . $value;
                break;
            case 'DEFAULT_MODULE':
                $value = $app . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $value;
        }
        define($const, $value);
    }
}

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . GF . DIRECTORY_SEPARATOR . 'Core' . DIRECTORY_SEPARATOR . 'AutoLoader.php';
AutoLoader::load();

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . CONFIG . DIRECTORY_SEPARATOR . 'routes.php';