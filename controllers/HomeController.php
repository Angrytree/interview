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

        $orderType = $request->get('order_type');
        if(in_array($orderType, $this->interview->orderTypeFields)){
            if($orderType == $this->interview->orderTypeFields[0]){
                $orderType = $this->interview->orderTypeFields[1];
            }else{
                $orderType = $this->interview->orderTypeFields[0];
            }
        }else{
            $orderType = 'asc';
        }



        $this->view('Header', ['auth' => true]);
        $this->view('Home', [
            'interviews' => $interviews,
            'statuses' => $statuses,
            'orderType' => $orderType
        ]);
        $this->view('Footer');
    }

}