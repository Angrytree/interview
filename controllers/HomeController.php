<?php

namespace controllers;

use core\Controller;
use core\Request;
use models\Interview;
use models\User;

class HomeController extends Controller {

    private User $user_model;

    public function __construct(){
        $this->user_model = new User();
        $this->interview_model = new Interview();
    }

    public function index(Request $request) {

        $data["users"] = $this->user_model->getUsers();
        
        $this->view('Home', $data);
    }

}