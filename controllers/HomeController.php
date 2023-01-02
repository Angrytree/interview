<?php

namespace controllers;

use core\Controller;
use core\Request;
use models\Interview;
use models\User;

class HomeController extends Controller {

    private Interview $interview;
    private User $user;

    public function __construct(){
        $this->interview = new Interview();
        $this->user = new User();
    }

    public function index(Request $request) {
        $interviews = $this->interview->getUserInterviews($request);
        $statuses = $this->interview->getInterviewStatuses();

        $this->view('Header', ['auth' => true]);
        $this->view('Home', [
            'interviews' => $interviews,
            'statuses' => $statuses,
            'order' => $request->get('order'),
            'orderType' => $request->get('order_type'),
            'api_token' => $this->user->getApiToken()
        ]);
        $this->view('Footer');
    }

}