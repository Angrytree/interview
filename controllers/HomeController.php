<?php

namespace controllers;

use core\Controller;
use core\Request;
use models\Interview;

class HomeController extends Controller {

    private Interview $interview;

    public function __construct(){
        $this->interview = new Interview();
    }

    public function index(Request $request) {
        $interviews = $this->interview->getUserInterviews($request);
        $statuses = $this->interview->getInterviewStatuses();

        $this->view('Header', ['auth' => true]);
        $this->view('Home', [
            'interviews' => $interviews,
            'statuses' => $statuses,
            'order' => $request->get('order'),
            'orderType' => $request->get('order_type')
        ]);
        $this->view('Footer');
    }

}