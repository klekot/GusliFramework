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
         foreach (self::$routes as $pattern => $route) {
             if (preg_match("#$pattern#i", $url, $matches)) {
                 foreach ($matches as $key => $value) {
                     if (is_string($key)) {
                         $route[$key] = $value;
                     }
                 }
                 if (!isset($route['module'])) $route['module'] = 'Main';
                 if (!isset($route['controller'])) $route['controller'] = 'Index';
                 if (!isset($route['action'])) $route['action'] = 'index';

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
}