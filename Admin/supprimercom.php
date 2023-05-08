<?php
	include_once 'C:/xampp/htdocs/Cyjam/Controller/CommentaireC.php';
	$blogC=new ReponseC();
	$blogC->supprimercommentaire($_POST["id"]);
	header('Location:affichercom.php');
?>