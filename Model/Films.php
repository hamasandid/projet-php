<?php
	class Film{
		private $idFilm=null;
		private $NomF=null;
		private $Duree=null;
		private $video=null;
		private $descriptionn=null;
		private $NomS=null;
		private $NbPlaces=null;
		
		

		
		function __construct($NomF,$Duree,$video,$descriptionn,$NomS,$NbPlaces){
			$this->NomF=$NomF;
			$this->Duree=$Duree;
			$this->video=$video;
			$this->descriptionn=$descriptionn;
			$this->NomS=$NomS;
			$this->NbPlaces=$NbPlaces;
		}
		function getidFilm(){
			return $this->idFilm;
		}
		function getNomF(){
			return $this->NomF;
		}
		function getDuree(){
			return $this->Duree;
		}
		function getvideo(){
			return $this->video;
		}
		function getdescriptionn(){
			return $this->descriptionn;
		}
		function getNomS(){
			return $this->NomS;
		}
		function getNbPlaces(){
			return $this->NbPlaces;
		}


		function setNomF(string $NomF){
			$this->NomF=$NomF;
		}
		function setDuree(time $Duree){
			$this->Duree=$Duree;
		}
		function setvideo(string $video){
			$this->video=$video;
		}
		function setdescriptionn(string $descriptionn){
			$this->descriptionn=$descriptionn;
		}
		function setNomS(string $NomS){
			$this->NomS=$NomS;
		}
		function setNbPlaces(string $NbPlaces){
			$this->NbPlaces=$NbPlaces;
		}

	}
?>