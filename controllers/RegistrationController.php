<?php

namespace controllers;

use core\Controller;
use core\Request;
use core\Response;
use models\User;

class RegistrationController extends Controller {

    private User $user;

    public function __construct(){
        $this->user = new User();
    }

    public function index() {
        $this->view('Header', ['isRegPage' => true]);
        $this->view('Registration');
        $this->view('Footer');
    }

    public function register(Request $request, Response $response) {
        if(!$this->user->register($request))
            $response->redirect('registration');
            
        $response->redirect('home');
    }

}