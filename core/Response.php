<?php

namespace core;

class Response {

    public function setStatusCode(int $code) {
        http_response_code($code);
    }

    public function json($data) {
        header('Content-Type: application/json;');
        return json_encode($data);
    }

    public function redirect($path) {
        header("Location: /$path", true, 301);
        die();
    }
}