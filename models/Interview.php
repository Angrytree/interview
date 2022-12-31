<?php

namespace models;

use core\Model;
use core\Request;

class Interview extends Model{

    public function getUserInterviews() {
        return $this->db
                ->query("SELECT iv.*, ivs.name as status 
                        FROM interviews iv 
                        LEFT JOIN interview_status ivs 
                            ON iv.status_id = ivs.id  
                        Where user_id={$this->session->user_id}")
                ->result();
    }

    public function getInterviewById(Request $request) {
        $id = $request->get('id');
        if(!$id)
            return false;

        $interview = $this->db
                        ->query("SELECT iv.*, ivs.name as status 
                                FROM interviews iv 
                                LEFT JOIN interview_status ivs 
                                    ON iv.status_id = ivs.id
                                WHERE iv.id = $id AND user_id={$this->session->user_id}")
                        ->result();

        if(!count($interview))
            return false;

        $answers = $this->db->query("SELECT * FROM answers WHERE interview_id = $id")->result();;
        $interview[0]['answers'] = $answers;

        $interview = $interview[0];

        return $interview;
    }

    public function getInterviewStatuses() {
        return $this->db->query("SELECT * FROM interview_status")->result();
    }

    public function add(Request $request) {
        $question = $request->post('question');
        $status_id = $request->post('status_id');

        if(!$question || !$status_id)
            return false;
        
        $status = $this->db->query("SELECT * FROM interview_status WHERE id = $status_id")->result();
        if(!count($status))
            return false;

        $this->db->query("INSERT INTO interviews (user_id, status_id, question)
                         VALUES ('{$this->session->user_id}', '$status_id', '$question')");
        
        return $this->db->insertId();
    }

    public function edit(Request $request) {
        $id = $request->post('id');
        $question = $request->post('question');
        $status_id = $request->post('status_id');

        if(!$question || !$status_id || !$id)
            return false;
        
        $inteview = $this->db->query("SELECT * FROM interviews WHERE id = $id AND user_id = {$this->session->user_id}")->result();
        if(!count($inteview))
            return $id;

        $status = $this->db->query("SELECT * FROM interview_status WHERE id = $status_id")->result();
        if(!count($status))
            return $id;
        
        if($inteview[0]['question'] != $question || $inteview[0]['status_id'] != $status_id)
            $this->db->query("UPDATE interviews SET question = '$question', status_id = '$status_id' WHERE id = $id");

        return $id;
    }

    public function delete(Request $request) {
        $id = $request->get('id');

        if(!$id)
            return false;

        $this->db->query("DELETE FROM interviews WHERE id = $id AND user_id = {$this->session->user_id}");

        return true;
    }
}