<?php
	include 'C:/xampp/htdocs/Cyjam/Controller/FilmsC.php';

	$message = "" ; 
	$FilmC=new FilmC();
	$FilmC->SupprimerFilm($_GET["idFilm"]);
	header('Location:AfficherFilm.php?message=	Film Supprimé avec succés');
?>