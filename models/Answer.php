<?php

namespace models;

use core\Model;
use core\Request;

class Answer extends Model{

    public function getAnswersByInterviewId($id) {
        if(!$id)
            return [];

        $answers = $this->db->query("SELECT * FROM answers WHERE interview_id = $id")->result();

        if(!count($answers))
            return [];
        else
            return $answers;
    }

    public function add(Request $request) {
        $interview_id = $request->post('interview_id');
        $text = $request->post('text');
        $count = $request->post('count');

        if(!$text || !$count || !$interview_id)
            return false;
        
        $interview = $this->db->query("SELECT * FROM interviews 
                                        WHERE id = $interview_id 
                                            AND user_id = {$this->session->user_id}")->result();
        if(!count($interview))
            return false;
        var_dump($interview);
        $this->db->query("INSERT INTO answers (interview_id, text, count)
                         VALUES ('$interview_id', '$text', '$count')");
        
        return $this->db->insertId();
    }

    public function edit(Request $request) {
        $id = $request->post('id');
        $interview_id = $request->post('interview_id');
        $text = $request->post('text');
        $count = $request->post('count');

        if(!$text || !$count || !$id || !$interview_id)
            return false;
        
        if(!$this->isAnswerOwner($id, $interview_id))
            return false;
        
        $this->db->query("UPDATE answers SET text = '$text', count = '$count' WHERE id = $id");

        return $id;
    }

    public function delete(Request $request) {
        $id = $request->get('id');
        $interview_id = $request->get('interview_id');

        if(!$id || !$interview_id)
            return false;
        
        if(!$this->isAnswerOwner($id, $interview_id))
            return false;

        $this->db->query("DELETE FROM answers WHERE id = $id");

        return true;
    }

    public function isAnswerOwner($id, $interview_id) {
        if(!$id)
            return false;

        if(!$interview_id)
            return false;
        
        $user_id = $this->db->query("SELECT user_id 
                                    FROM interviews 
                                    WHERE id =$interview_id 
                                        AND user_id = {$this->session->user_id}")->result();
        if(!count($user_id))
            return false;
        else
            return true;
    }
}