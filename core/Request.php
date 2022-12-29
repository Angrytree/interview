<?php

namespace core; 

class Request {

    private string $path;
    private string $method;

    public function __construct() {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);

        $uri = $_SERVER['REQUEST_URI'];
        $paramsPosition = strpos($uri, '?');
        if(!$paramsPosition)
            $this->path = $uri;
        else
            $this->path = substr($uri, 0, $paramsPosition);

        
        
    }

    public function getPath() {
        return $this->path;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getParams() {
        return ['name' => 'John'];
    }


}