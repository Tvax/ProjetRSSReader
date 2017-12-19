<?php

session_start();

require_once 'controllers/admin.php';
require_once 'models/admin.php';
require_once 'views/admin.php';

$modelAdmin = new ModelAdmin();
$controllerAdmin = new ControllerAdmin($modelAdmin);


//si ya une session ouverte et si la session est bonne
if(!empty($_SESSION["admin"]) && $controllerAdmin->CheckSessionID($_SESSION["admin"])){
    $viewAdmin = new AdminView($controllerAdmin, $modelAdmin);
    echo $viewAdmin->output();
}

//si ya pas de session ouverte mais que un user et password on ete envoye en POST de la page index.php
elseif(!empty($_POST["username"]) && $controllerAdmin->ValidUser($_POST['username'], $_POST['password'])){
    //assigne une session
    $controllerAdmin->CreateNewSession();
    $viewAdmin = new AdminView($controllerAdmin, $modelAdmin);
    echo $viewAdmin->output();
}
//on renvoie l'user sur la page index avec une erreur de credentials
else{
    $viewAdmin = new AdminView($controllerAdmin, $modelAdmin);
    $viewAdmin->Homepage("?err"); //avec ?err en parmetre
}