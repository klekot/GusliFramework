<?php
namespace GF\Core;

use \GF\Utils\Utils as Utils;
class Router
{

    protected static $routes = [];
    protected static $route  = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function matchRoute($url)
    {
        if (strpos($url, '?')) {
            $urlParts =explode('?', $url);
            $url = $urlParts[0];
            $params = $urlParts[1];
        }
        foreach (self::$routes as $pattern => $route) {
             if (preg_match("#$pattern#i", $url, $matches)) {
                 foreach ($matches as $key => $value) {
                     if (is_string($key)) {
                         $route[$key] = $value;
                     }
                 }
                 if (!isset($route['module'])    ) $route['module']     = 'Main';
                 if (!isset($route['controller'])) $route['controller'] = 'Index';
                 if (!isset($route['action'])    ) $route['action']     = 'index';
                 if (isset($params) && !empty($params)) {
                     $paramsPairs = explode('&', $params);
                     foreach ($paramsPairs as $paramsPair) {
                         $paramsPair = explode('=', $paramsPair);
                         $route['params'][$paramsPair[0]] = $paramsPair[1];
                     }
                 }

                 self::$route = $route;
                 return true;
             }
         }
         return false;
    }

    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $module     = Utils::camelCaseNaming(self::$route['module'], 'module');
            $controller = Utils::camelCaseNaming(self::$route['controller'], 'controller');
            $action     = Utils::camelCaseNaming(self::$route['action'], 'action');

            $controller = $module . 'controllers\\' . $controller;
            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $controllerObject->$action();
            } else {
                echo "controller <b>$controller</b> not found";
            }

        } else {
            http_response_code(404);
            include '404.html';
        }
    }

    public static function redirect($url)
    {
        $parts  =
        $params = [];

        if (is_array($url)) {
            foreach ($url as $key => $value) {
                switch ($key) {
                    case 'module':
                        $parts['module'] = $value;
                        break;
                    case 'controller':
                        $parts['controller'] = $value;
                        break;
                    case 'action':
                        $parts['action'] = $value;
                        break;
                    case 'params':
                        foreach ($value as $param => $paramValue) {
                            $params[] = $param.'='.$paramValue;
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        $paramsPartOfQuery = (count($params)) ? '?' . implode('&', $params) : '';

        $query = implode('/', array_replace(self::$route, $parts)) . $paramsPartOfQuery;

        self::dispatch($query);
    }
}