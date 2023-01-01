<?php

namespace core; 

class Request {

    private string $path;
    private string $method;
    private array $headers;
    private array $json;
    private array $post;
    private array $get;

    public function __construct() {
        $this->headers = getallheaders();
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);

        $uri = $_SERVER['REQUEST_URI'];
        $paramsPosition = strpos($uri, '?');
        if(!$paramsPosition)
            $this->path = $uri;
        else
            $this->path = substr($uri, 0, $paramsPosition);

        if($this->isJson()) {
            $this->json = json_decode(file_get_contents('php://input'), true);
        }

        if($this->isGet()){
            foreach($_GET as $name => $value){
                $this->get[$name] = filter_input(INPUT_GET, $name, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->isPost()){
            foreach($_POST as $name => $value){
                $this->post[$name] = filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

    }

    public function getPath() {
        return $this->path;
    }

    public function getMethod() {
        return $this->method;
    }

    public function isGet() {
        return $this->method === 'get';
    }

    public function isPost() {
        return $this->method === 'post';
    }

    public function isJson() {
        if(isset($this->headers['Content-Type'])){
            return $this->headers['Content-Type'] === 'application/json';
        }
        else
            return false;
    }


    public function get($param='') {
        if(!$param)
            return $this->get;
        else
            return $this->get[$param] ?? false;
    }

    public function post($param='') {
        if(!$param)
            return $this->post;
        else
            return $this->post[$param] ?? false;
    }

    public function json($param='') {
        if(!$param)
            return $this->json;
        else
            return $this->json[$param] ?? false;
    }


}