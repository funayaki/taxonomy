<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin('Taxonomy', ['path' => '/'], function (RouteBuilder $route) {
    $route->prefix('admin', function (RouteBuilder $route) {
        $route->scope('/taxonomy', [], function (RouteBuilder $route) {
            $route->fallbacks();
        });
    });
});
