<?php
	$dbb=new mysqli("localhost", "root", "", "db_jntsoft");
	if($dbb->connect_error)
	{
		die("Could not connect to the database!".$dbb->connect_error);
	}
?>