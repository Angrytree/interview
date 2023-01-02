<?php

namespace controllers;

use core\Controller;
use core\Request;
use core\Response;
use models\Interview;

class ApiController extends Controller {

    private Interview $interview;

    public function __construct(){
        $this->interview = new Interview();
    }


    public function getRandomInterview(Request $request, Response $response) {
        $interview = $this->interview->getRandomInterview($request);
        return $response->json($interview);
    }

}