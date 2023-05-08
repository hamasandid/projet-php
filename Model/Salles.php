<?php
	class Salle{
        // Variable to use
		private $idS=null;
		private $NomS=null;
		private $NbPlaces=null;

		
		

        // Constructeur for the class Salle
		function __construct($NomS,$NbPlaces){
			$this->NomS=$NomS;
			$this->NbPlaces=$NbPlaces;
		}

        // Getters
		function getidS(){
			return $this->idS;
		}
		function getNomS(){
			return $this->NomS;
		}
		function getNbPlaces(){
			return $this->NbPlaces;
		}
		
		

        // Setters
		function setNomS(string $NomS){
			$this->NomS=$NomS;
		}
		function setNbPlaces(number $NbPlaces){
			$this->NbPlaces=$NbPlaces;
		}


	}
?>