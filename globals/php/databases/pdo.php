<?php
	$db_name = "default_mfp";
	
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname='.$db_name, 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
