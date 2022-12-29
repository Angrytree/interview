<?php

namespace core;

use database\Database;

class Application {

    public Session $session;
    public Database $db;
    public Router $router;
    public Request $request;
    public Response $response;
    public static $instance;

    public function __construct() {
        $this->session = new Session();
        $this->db = new Database();
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();
        self::$instance = $this;
    }

    public function run() {
        $this->router->handle($this->request, $this->response);
    }

}