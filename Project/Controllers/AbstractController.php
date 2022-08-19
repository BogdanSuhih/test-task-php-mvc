<?php

namespace Project\Controllers;

use Project\Models\Records\Record;
use Project\Models\Users\WorkCookies;
use Project\Views\View;

class AbstractController
{
    public $user;
    public $userRecords;
    public $view;

    public function __construct()
    {
        $this->user = WorkCookies::checkUserCookie();
        $this->view = new View(__DIR__ . '/../../templates/');
    }
}
