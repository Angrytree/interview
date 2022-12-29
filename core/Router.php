<?php

namespace core;

class Router {

    private array $routes = [];

    public function __construct() {
        
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function handle(Request $request) {
        $callback = $this->routes[$request->getMethod()][$request->getPath()];
        $instance = new $callback[0];
        $callback[0] = $instance; 
        call_user_func($callback, $request);
    } 

}