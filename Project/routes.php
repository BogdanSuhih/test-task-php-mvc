<?php
use Project\Controllers\MainController;
use Project\Controllers\UserController;
use Project\Controllers\RecordController;

return [
    "~^$~" => [MainController::class, 'main'],
    "~^install$~" => [MainController::class, 'install'],
    "~^login(.*)$~" => [UserController::class, 'login'],
    "~^logout(.*)$~" => [UserController::class, 'logout'],
    "~^register(.*)$~" => [UserController::class, 'register'],
    "~^addrecord(.*)$~" => [RecordController::class, 'addRecord'],
];
