<?php

namespace core;

class Controller {

    public function view($view, ?array $data) {

        foreach($data as $key => $value) {
            $$key = $value;
        }

        include_once dirname(__DIR__) . "/views/$view.php"; 
    }

}