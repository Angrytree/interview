<?php

namespace core;

class Router {

    public static $routes = [];

    private $_routes;

    public function __construct() {
        $this->_routes = self::$routes;
    }

    public static function get($path, $callback) {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path, $callback) {
        self::$routes['post'][$path] = $callback;
    }

    public function handle(Request $request, Response $response) {

        if(!isset($this->_routes[$request->getMethod()])
            ||!isset($this->_routes[$request->getMethod()][$request->getPath()])) {

            $response->setStatusCode(404);
            return $this->view('404'); 
        }

        $callback = $this->_routes[$request->getMethod()][$request->getPath()];
        $instance = new $callback[0];
        $callback[0] = $instance; 
        call_user_func($callback, $request);
    }

    public function view($view) {
        include_once dirname(__DIR__) . "/views/$view.php";
    }

}