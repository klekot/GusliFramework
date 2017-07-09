<?php
/**
 *
 */

use \GF\Core\Router as Router;

$query = rtrim($_SERVER['QUERY_STRING'], '/');

//  User routes
//  Plase your custom routes here:

//  replase me :)

//  Main routes
Router::add('^$', ['module' => 'Main', 'controller' => 'Index', 'action' => 'index']);

if (MODULES_ENABLED) {
    Router::add('^(?P<module>[a-z-]+)$');
    Router::add('^(?P<module>[a-z-]+)/(?P<controller>[a-z-]+)?$');
    Router::add('^(?P<module>[a-z-]+)/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

} else {
    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
}

Router::dispatch($query);