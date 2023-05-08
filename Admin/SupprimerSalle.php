<?php
	include 'C:/xampp/htdocs/Cyjam/Controller/SallesC.php';
	

	$message = "" ; 
	$SalleC=new SalleC();
	$SalleC->SupprimerSalle($_GET["idS"]);
	header('Location:AfficherSalles.php?message= Salle Supprimé avec succés');
?>