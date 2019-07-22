<?php
class controller {

	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		require 'views/'.$viewName.'.php';
	}

	public function loadLogin($viewName, $viewData = array()) {
		if ( !isset ($_SESSION["sistema"]["id"]) ) {

			header("Location: ".BASE."Login");
			exit;
		} else {
			require 'views/Login/Login.php';	
		}
	}

	public function loadTemplateAdmin($viewName, $viewData = array()) {
		require 'views/Admin/Dashboard.php';
	}

	public function loadTemplateMecanico($viewName, $viewData = array()) {
		$this->VerificarLoginMecanico();
		require 'views/Mecanico/Painel.php';
	}


	public function VerificarLogin() {
			
		if ( !isset ($_SESSION["sistema"]["id"]) ) {

			header("Location: ".BASE."Login");
			exit;
		} else if (($_SESSION["sistema"]["cargo"] != 'Admin') AND ( $_SESSION["sistema"]["cargo"] != 'Atendente')) {
			echo '<script>alert("Acesso Negado!");history.back();</script>';
			exit;
		}
	}

	public function VerificarNivel($nivel) {
			
		if ($nivel == 1 && $_SESSION["sistema"]["cargo"] != 'Admin') {

			echo '<script>alert("Acesso Negado!");history.back();</script>';
			exit;

		} else if (($nivel == 2) && ($_SESSION["sistema"]["cargo"] != 'Admin') AND ($_SESSION["sistema"]["cargo"] != 'Atendente')) {
			
			echo '<script>alert("Acesso Negado!");history.back();</script>';
			exit;

		}
	}

	public function VerificarLoginMecanico() {
			
		if ( !isset ($_SESSION["sistema"]["id"]) ) {

			header("Location: ".BASE."Login");
			exit;
		} else if ($_SESSION["sistema"]["cargo"] != 'Mecânico') {
			echo '<script>alert("Acesso Negado!");history.back();</script>';
			exit;
		}
	}
	

}