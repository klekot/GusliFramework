<?php
/**
 *
 */
namespace GF\Utils;

class Utils
{
    public static function debug($arr)
    {
        echo '<pre>' . print_r($arr, true) . '</pre>';
    }

    public static function camelCaseNaming($name, $type = '')
    {
        if (false !== strpos($name, '-')) {
            $parts = explode('-', $name);
            $upFirst = function ($part) { return ucfirst($part);};
            $name = implode('', array_map($upFirst, $parts));
        }
        $type = ucfirst(strtolower($type));
        $name = ucfirst($name);
        if ($type == 'Action') lcfirst($name);
        if ($type == 'Module') return $name . '\\' ;
        return $name . $type;
    }
}
