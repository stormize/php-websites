<?php

	session_start();
	session_unset();
	session_destroy();
	setcookie("Remember_User", "", time() -3600);
	setcookie("Remember_Password", "", time() -3600);
	
	header("Location: index.php");
	exit();