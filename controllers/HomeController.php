<?php

namespace controllers;

use core\Controller;

class HomeController extends Controller {

    public function __construct(){
    }

    public function index() {
        $this->view('Header', ['auth' => true]);
        $this->view('Home');
        $this->view('Footer');
    }

}