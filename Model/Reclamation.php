<?php
	class Reclamation{
		private $id=null;
		private $nomclient=null;
		private $cin=null;
		private $email=null;
		private $texte=null;
		
		function __construct($nomclient,$cin,$email,$texte){
			$this->nomclient=$nomclient;
			$this->cin=$cin;
			$this->email=$email;
			$this->texte=$texte;
		}


		function getnomclient(){
			return $this->nomclient;
		}
		function getcin(){
			return $this->cin;
		}
		function getemail(){
			return $this->email;
		}
		function gettexte(){
			return $this->texte;
		}



		function setnomclient(string $nomclient){
			$this->nomclient=$nomclient;
		}
		function setcin(string $cin){
			$this->cin=$cin;
		}
		function setemail(string $email){
			$this->email=$email;
		}
		function settexte(string $texte){
			$this->texte=$texte;
		}
		
	}


?>