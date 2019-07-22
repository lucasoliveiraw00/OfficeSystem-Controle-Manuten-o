<?php

	define("BASE", "http://localhost/OfficeSystem/");

	$server = "localhost";
	$dbname = "office";
	$user = "root";
	$pass = "";

global $db;
try {
	$db = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8",$user,$pass);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}