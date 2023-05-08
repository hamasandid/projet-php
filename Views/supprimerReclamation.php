<?php
	include '../Controller/ReclamationC.php';
	$reclamationc=new ReclamationC();
	$reclamationc->supprimerreclamation($_GET["id"]);
	header('Location:afficherListeReclamation.php');
?>