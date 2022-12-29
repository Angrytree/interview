<?php

namespace core;

use database\Database;

class Model {

    public $db;
    
    public function __construct() {
        $this->db = Application::$instance->db;
    }

}