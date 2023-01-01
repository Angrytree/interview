<?php

namespace controllers;

use core\Controller;
use core\Request;
use core\Response;
use models\Answer;

class AnswerController extends Controller {

    private Answer $answer;

    public function __construct(){
        $this->answer = new Answer();
    }

    public function store(Request $request, Response $response) {
        $this->answer->add($request);
        $interview_id = $request->post('interview_id');
        if(!$interview_id)
            $response->redirect('home');
        else
            $response->redirect("interview/show?id=$interview_id");
    }

    public function edit(Request $request, Response $response) {
        $this->answer->edit($request);
        $interview_id = $request->post('interview_id');
        if(!$interview_id)
            $response->redirect('home');
        else
            $response->redirect("interview/show?id=$interview_id");
    }

    public function delete(Request $request, Response $response) {
        $this->answer->delete($request);
        $interview_id = $request->get('interview_id');
        if(!$interview_id)
            $response->redirect('home');
        else
            $response->redirect("interview/show?id=$interview_id");
    }


}