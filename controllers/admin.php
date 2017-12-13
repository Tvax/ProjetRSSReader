<?php

class ControllerAdmin{

	private $modelAdmin;
	private $admin;

	public function isAdmin(){
		return $admin;
	}
	
	function __construct($modelAdmin){
		$this->modelAdmin = $modelAdmin;
	}

	public function createNewSession(){
		//associer un id en tant que cookie
	}

	public function validUser($username, $password){
		return $this->modelAdmin->isValidUser($username, $password);
	}
}
