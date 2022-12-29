<?php

namespace models;
use core\Model;

class User extends Model {

    public function getUsers() {
        return $this->db->query("Select * from users")->result();
    }

}