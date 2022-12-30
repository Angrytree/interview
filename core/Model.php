<?php

namespace core;

use database\Database;

class Model {

    public $db;
    public $session;
    
    public function __construct() {
        $this->db = Application::$instance->db;
        $this->session = Application::$instance->session;
    }

}