<?php

class ControllerAdmin{

	private $modelAdmin;
	private $admin;
	private $max_news;
	private $url;
	private $urlAction;

	public function isAdmin(){
		return $admin;
	}
	
	function __construct($modelAdmin){
		$this->modelAdmin = $modelAdmin;
		if(checkIfMaxNewsUpdated()){
			$this->modelAdmin->setMaxNews($max_news);
		}
		if(checkIfUrlUpdated()){
			$this->modelAdmin->UpdateUrl($url, $urlAction);
		}
	}

	public function createNewSession(){
		//associer un id en tant que cookie
	}

	public function validUser($username, $password){
		return $this->modelAdmin->isValidUser($username, $password);
	}

	private function checkIfMaxNewsUpdated(){
		if(isset($_POST['max_news']){
			$this->max_news = $_POST['max_news'];
			var_dump(filter_var($this->max_news, FILTER_SANITIZE_NUMBER_INT));
			return true;
		}
		return false;
	}

	private function checkIfUrlUpdated(){
		if(isset($_POST['max_news']){
			$this->max_news = $_POST['max_news'];
			var_dump(filter_var($this->max_news, FILTER_SANITIZE_NUMBER_INT));
			return true;
		}
		return false;
	}

	private function checkIfUrlUpdated(){
		if(isset($_POST['url'])){
			$this->url = $_POST['url'];
			var_dump(filter_var($this->url, FILTER_VALIDATE_URL));
			if(rmOrAdd()){
				return true;
			}
		}
		return false;
	}

	private function rmOrAdd(){
		if(isset($_POST['contact'])){
			$this->urlAction = $_POST['contact'];

			if($this->urlAction == 'rm'){
				return true;
			}
			else if($this->urlAction = 'add'){
				return true;
			}
		}
		return false;
	}
}
