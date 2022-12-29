<?php

namespace controllers;

use core\Controller;
use core\Request;

class HomeController extends Controller {

    /*public function index(Request $request) {
        $this->view("Home", $request->getParams);
    }*/

    public function index(Request $request) {
        $this->view('Home', $request->getParams());
    }

}