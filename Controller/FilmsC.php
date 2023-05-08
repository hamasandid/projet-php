<?php
		include 'C:/xampp/htdocs/Cyjam/Config.php';
		include_once 'C:/xampp/htdocs/Cyjam/Model/Films.php';
	class FilmC {




/////..............................Afficher............................../////
		function AfficherFilm(){
			$sql="SELECT * FROM films";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

/////..............................Supprimer............................../////
		function SupprimerFilm($idFilm){
			$sql="DELETE FROM films WHERE idFilm=:idFilm";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idFilm', $idFilm);   
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}


/////..............................Ajouter............................../////
		function AjouterFilm($films){
			$sql="INSERT INTO films (NomF,Duree,video,descriptionn,idS) 
			VALUES (:NomF,:Duree,:video,:descriptionn,:idS)";
			
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'NomF' => $films->getNomF(),
					'Duree' => $films->getDuree(),
					'video' => $films->getvideo(),
					'descriptionn' => $films->getdescriptionn(),
					'idS' => $films->getNomS(),
					'idS' => $films->getNbPlaces(),
					
			]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
/////..............................Affichage par la cle Primaire............................../////
		function RecupererFilm($idFilm){
			$sql="SELECT * from films where idFilm=$idFilm";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$films=$query->fetch();
				return $films;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

/////..............................Affichage par salle............................../////
function RecupererFilmParSalle($id){
	$sql="SELECT * from films where idS=$id";
	$db = config::getConnexion();
	try{
		$query=$db->prepare($sql);
		$query->execute();

		return $query;
	}
	catch (Exception $e){
		die('Erreur: '.$e->getMessage());
	}
}

		/////..............................tri............................../////
function triFilms(){
	$sql="SELECT * FROM films order by NomF ASC";
	$db = config::getConnexion();
	try{
		$liste = $db->query($sql);
		return $liste;
	}
	catch(Exception $e){
		die('Erreur:'. $e->getMessage());
	}
}
/////..............................tri Par Prix longue............................../////
function TriDureeAs(){
	$sql="SELECT * FROM films order by Duree ASC";
	$db = config::getConnexion();
	try{
		$liste = $db->query($sql);
		return $liste;
	}
	catch(Exception $e){
		die('Erreur:'. $e->getMessage());
	}
}
/////..............................tri Par duree courte............................../////
function TriDureeDec(){
	$sql="SELECT * FROM films order by Duree DESC";
	$db = config::getConnexion();
	try{
		$liste = $db->query($sql);
		return $liste;
	}
	catch(Exception $e){
		die('Erreur:'. $e->getMessage());
	}
}

/////..............................Update............................../////
		function ModifierFilm($films,$idFilm){
			try {
				$db = config::getConnexion();
		$query = $db->prepare('UPDATE films SET  NomF = :NomF, Duree = :Duree, video = :video, descriptionn = :descriptionn , idS = :idS WHERE idFilm= :idFilm');
				$query->execute([
					'NomF' => $films->getNomF(),
					'Duree' => $films->getDuree(),
					'video' => $films->getvideo(),
					'descriptionn' => $films->getdescriptionn(),
					'idS' => $films->getNomS(),
					'idS' => $films->getNbPlaces(),
					'idFilm' => $idFilm
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		
		/////..............................Recuperer salle............................../////
		function RecupererSalle($idS){
			$sql="SELECT * from salles where idS=$idS";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$salles=$query->fetch();
				return $salles;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
   

		
		/////..............................search............................../////
		function Recherche($nomP){
			$sql="SELECT * from films where NomF like '".$nomP."%' ";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		
		function AfficherSalle(){
			$sql="SELECT * FROM salles";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		

        } 
	?>
