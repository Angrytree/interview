<?php

namespace controllers;

use core\Controller;
use core\Request;
use core\Response;
use models\Interview;

class InterviewController extends Controller {

    private Interview $interview;

    public function __construct(){
        $this->interview = new Interview();
    }

    public function index() {
        $this->view('Header');
        $this->view('interview/Create');
        $this->view('Header');
    }

    public function show(Request $request, Response $response) {
        $interview = $this->interview->getInterviewById($request);
        if(!$interview)
            $response->redirect('home');
        
        $statuses = $this->interview->getInterviewStatuses();

        $this->view('Header', ['auth' => true]);
        $this->view('interview/Show', [
            'interview' => $interview,
            'statuses' => $statuses
        ]);
        $this->view('Footer');
    }

    
    public function store(Request $request, Response $response) {
        $this->interview->add($request);
        $response->redirect('home');
    }

    public function edit(Request $request, Response $response) {
        $id = $this->interview->edit($request);
        $response->redirect("interview/show?id=$id");
    }

    public function delete(Request $request, Response $response) {
        $this->interview->delete($request);
        $response->redirect('home');
    }


}