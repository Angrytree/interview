<?php

namespace controllers;

use core\Controller;
use models\Interview;

class HomeController extends Controller {

    private Interview $interview;

    public function __construct(){
        $this->interview = new Interview();
    }

    public function index() {
        $interviews = $this->interview->getUserInterviews();
        $statuses = $this->interview->getInterviewStatuses();

        $this->view('Header', ['auth' => true]);
        $this->view('Home', [
            'interviews' => $interviews,
            'statuses' => $statuses
        ]);
        $this->view('Footer');
    }

}