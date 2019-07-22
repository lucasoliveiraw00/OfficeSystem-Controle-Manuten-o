<?php
class HomeController extends controller {

	public function index() {
		$this->VerificarLogin();
		$this->VerificarNivel(2);
		$dados = array();
	
		$this->loadView('Admin/Dashboard', $dados);

	}

}