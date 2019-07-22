<?php
class NotfoundController extends controller {

	public function index() {
		
		$this->loadView('404', array());
	}

}