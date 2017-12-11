


<?php


	// Enable this to display error message 
	error_reporting(0);

	$DB_HOST		=	"localhost";
	$DB_LOGIN		=	"root";
	$DB_PASSWORD	=	"";
	$DB_NAME		=	"DatabaseName";


	$conn=mysqli_connect($DB_HOST,$DB_LOGIN,$DB_PASSWORD);

	if(!$conn)
	{
		die('Connection failed'.mysqli_error($conn));
	}

	
 ?>
