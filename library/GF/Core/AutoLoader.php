<?php

/**
 *
 */

class AutoLoader {
    public static function load()
    {
        require_once ROOT . DIRECTORY_SEPARATOR . 'vendor'  . DIRECTORY_SEPARATOR . 'autoload.php';

        spl_autoload_register(function ($class) {
            $class_filename = str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
            $class_root = ROOT;
            $cache_file = ROOT. DIRECTORY_SEPARATOR . CACHE . DIRECTORY_SEPARATOR . 'classpaths.cache';
            $path_cache = (file_exists($cache_file)) ? unserialize(file_get_contents($cache_file)) : array();
            if (!is_array($path_cache)) { $path_cache = array(); }

            if (CACHE_ENABLED && array_key_exists($class, $path_cache)) {
                if (file_exists($path_cache[$class])) { require_once $path_cache[$class]; }
            } else {
                $directories = new RecursiveDirectoryIterator($class_root);
                foreach(new RecursiveIteratorIterator($directories) as $file) {
                    $real = $file->getRealPath();
                    if (false !== strpos($file->getRealPath(), $class_filename)) {
                        $full_path = $file->getRealPath();
                        $path_cache[$class] = $full_path;
                        require_once $full_path;
                        break;
                    }
                }
            }

            $serialized_paths = serialize($path_cache);
            if ($serialized_paths != $path_cache) { file_put_contents($cache_file, $serialized_paths); }
        });
    }
}