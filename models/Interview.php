<?php

namespace models;

use core\Model;
use core\Request;

class Interview extends Model{

    private Answer $answer;

    private array $orderFields = [
        'id' => 'id',
        'status' => 'status_id',
        'question' => 'question',
        'date' => 'date'
    ];

    public array $orderTypeFields = ['asc', 'desc'];

    public function __construct() {
        parent::__construct();
        $this->answer = new Answer();
    }

    public function getUserInterviews(Request $request) {
        $order = $request->get('order');
        $orderType = strtolower($request->get('order_type')); 
        $orderQuery = "";
        if(isset($this->orderFields[$order]) && in_array($orderType, $this->orderTypeFields)){
            $orderQuery = "ORDER BY {$this->orderFields[$order]} $orderType";
        }

        return $this->db
                ->query("SELECT iv.*, ivs.name as status 
                        FROM interviews iv 
                        LEFT JOIN interview_status ivs 
                            ON iv.status_id = ivs.id  
                        WHERE user_id={$this->session->user_id}
                        $orderQuery")
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

        $answers = $this->answer->getAnswersByInterviewId($id);
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

    /*
    * Api methods
    */

    public function getRandomInterview(Request $request) {
        $user = $this->db->query("SELECT id FROM users WHERE api_token = '{$request->getApiToken()}'")->result();
        if(!count($user))
            return [];

        $interview = $this->db
        ->query("SELECT iv.*, ivs.name as status 
                FROM interviews iv 
                LEFT JOIN interview_status ivs 
                    ON iv.status_id = ivs.id
                WHERE status_id = 2 AND user_id={$user[0]['id']}
                ORDER BY RAND()
                LIMIT 1")
        ->result();

        if(!count($interview))
            return [];

        $answers = $this->answer->getAnswersByInterviewId($interview[0]['id']);
        $interview[0]['answers'] = $answers;

        $interview = $interview[0];

        return $interview;
        
    }
}