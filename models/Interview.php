<?php

namespace models;

use core\Model;

class Interview extends Model{

    public function getInterviews() {
        return $this->db->query("Select * from interviews")->result();
    }

}