<?php
	include_once 'C:/xampp/htdocs/Cyjam/Controller/BlogC.php';
	$blogC=new BlogC();
	$blogC->supprimerblog($_POST["id"]);
	header('Location:afficherblog.php');
?>