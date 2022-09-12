<?php
	try{
		$db= new PDO('mysql:host=localhost;dbname=db_jntsoft','root','');
	}
	catch(Exception $e ){
		die('votre connection a échouée');
	}
?>