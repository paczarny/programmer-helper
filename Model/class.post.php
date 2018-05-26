<?php

include('class.password.php');

class User extends User{

    private $_db;

	function __construct($db){
		parent::__construct();

		$this->_db = $db;
	}

	

}


?>
