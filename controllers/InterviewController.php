<?php

namespace controllers;

use core\Controller;

class InterviewController extends Controller {

    public function __construct(){
    }

    public function index() {
        $this->view('Header');
        $this->view('interview/Create');
        $this->view('Header');
    }

    public function store() {

    }

    public function show() {

    }

    public function edit() {
        
    }




}