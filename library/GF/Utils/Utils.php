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
        if ($type == 'Module') return ucfirst($name) . '\\' ;
        return $name . $type;
    }

    public static function loadYaml($file, $env = NULL)
    {
        $sets = yaml_parse_file($file);
        switch (current(array_keys($sets))) {
            case 'environments':
            case 'connections':
                foreach ($sets as $set) {
                    foreach ($set as $const => $value ) {
                        if ($const != $env) continue;
                        if (is_array($value)) {
                            $prefix = '';
                            foreach ($value as $const1 => $value1 ) {
                                if (basename($file, '.yml') == 'db_connections') {
                                    $prefix = 'DB_';
                                }
                                define($prefix.strtoupper($const1), $value1);
                            }
                        }
                    }
                }
                break;
            default:
                foreach ($sets as $set) {
                    if (is_null($set)) continue;
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
                            case 'MODELS':
                                $value = ROOT. DIRECTORY_SEPARATOR . $app . DIRECTORY_SEPARATOR . $value;
                                break;
                            case 'DEFAULT_MODULE':
                                $value = $app . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $value;
                            case 'LAYOUT_MAIN':
                                $value = $app . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $value . '.php';
                        }
                        define($const, $value);
                    }
                }
        }
    }

    public static function normalizeContent($viewContent, $layoutContent)
    {
        $content = preg_replace('/'.CONTENT_PLACEHOLDER.'/', $viewContent, $layoutContent);
        $normalizedContent = '';
        $positionsOfBegins = self::_getOccurrence($content, '<?php');
        $positionsOfEnds   = self::_getOccurrence($content, '?>');

        if (count($positionsOfBegins) != count($positionsOfEnds)) {
            foreach ($positionsOfBegins as $bKey => $begin) {
                foreach ($positionsOfEnds as $eKey => $end) {
                    if (isset($positionsOfEnds[$bKey]) && $positionsOfBegins[$bKey] < $positionsOfEnds[$bKey]) {
                        continue;
                    } else {
                        $normalizedContent = preg_replace('/'.CONTENT_PLACEHOLDER.'/', $viewContent . '?>', $layoutContent);
                    }
                }
            }
        } else {
            $normalizedContent = $content;
        }

        return $normalizedContent;
    }

    private static function _getOccurrence($string, $subString)
    {
        $lastPos = 0;
        $positions = array();
        while (($lastPos = strpos($string, $subString, $lastPos))!== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($subString);
        }
        return $positions;
    }
}
