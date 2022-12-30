<?php

namespace controllers;

use core\Controller;
use core\Request;
use core\Response;
use models\User;

class LoginController extends Controller {

    private User $user;

    public function __construct(){
        $this->user = new User();
    }

    public function index() {
        $this->view('Header', ['isLoginPage' => true]);
        $this->view('Login');
        $this->view('Footer');
    }

    public function login(Request $request, Response $response) {
        if(!$this->user->login($request))
            $response->redirect("");
        
        $response->redirect('home');
    }

    public function logout(Request $request, Response $response) {
        if(!$this->user->logout())
            $response->redirect("");
    }

}