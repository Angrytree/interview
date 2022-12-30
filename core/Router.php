<?php

namespace core;

class Router {

    public static $routes = [];

    private $_routes;

    public function __construct() {
        $this->_routes = self::$routes;
    }

    public static function get($path, $callback, $type = 'default') {
        self::$routes['get'][$path]['callback'] = $callback;
        self::$routes['get'][$path]['type'] = $type;
    }

    public static function post($path, $callback, $type = 'default') {
        self::$routes['post'][$path]['callback'] = $callback;
        self::$routes['post'][$path]['type'] = $type;
    }

    public function handle(Request $request, Response $response) {

        if(!isset($this->_routes[$request->getMethod()])
            ||!isset($this->_routes[$request->getMethod()][$request->getPath()])) {

            $response->setStatusCode(404);
            return $this->view('404'); 
        }

        $type = $this->_routes[$request->getMethod()][$request->getPath()]['type'];

        if($type == 'auth' && !Application::$instance->session->isAuth()){
            $response->redirect('registration');
        }

        $callback = $this->_routes[$request->getMethod()][$request->getPath()]['callback'];
        $instance = new $callback[0];
        $callback[0] = $instance; 
        return call_user_func($callback, $request, $response);
    }

    public function view($view) {
        include_once dirname(__DIR__) . "/views/$view.php";
    }

}