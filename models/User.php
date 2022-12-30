<?php

namespace models;
use core\Model;
use core\Request;

class User extends Model {

    public function register(Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');
        if(!$email || !$password)
            return false;

        $user = $this->db->query("Select id From users Where email ='$email'")->result();
        if(count($user)){
            return false;
        }

        $passwordHash = md5("some{$password}string");
        $apiToken = md5(uniqid($email, true));

        $result = $this->db->query("Insert into users (email, password, api_token) values ('$email', '$passwordHash', '$apiToken')")->insertId();

        $this->session->user_id = $result;

        return $result;

    }

    public function login(Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');
        if(!$email || !$password)
            return false;
        
        $passwordHash = md5("some{$password}string");
        $user = $this->db->query("Select id From users Where email = '$email' and password = '$passwordHash'")->result();
        if(!count($user))
            return false;

        $this->session->user_id = $user[0]['id'];
        
        return true;
    }

    public function logout() {
        $this->session->close();
    }

}