<?php

namespace core;

class Session {

    public function __construct() {
        session_start();
        foreach($_SESSION as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __set($name, $value){
        $_SESSION[$name] = $value;
        $this->$name = $value;
    }


    public function close() {
        session_unset();
        session_destroy();
    }

}