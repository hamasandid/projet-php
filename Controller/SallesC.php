<?php
			include  'C:/xampp/htdocs/Cyjam/Config.php';
			include_once 'C:/xampp/htdocs/Cyjam/Model/Salles.php';
	class SalleC {

/////..............................Afficher............................../////
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

/////..............................Supprimer............................../////
		function SupprimerSalle($idS){
			$sql="DELETE FROM salles WHERE idS=:idS";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idS', $idS);   
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}


/////..............................Ajouter............................../////
		function AjouterSalle($salles){
			$sql="INSERT INTO salles (NomS,NbPlaces) 
			VALUES (:NomS,:NbPlaces)";
			
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'NomS' => $salles->getNomS(),
					'NbPlaces' => $salles->getNbPlaces(),
					
			]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
/////..............................Affichage par la cle Primaire............................../////
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

			/////..............................Update............................../////
		function ModifierSalle($salles,$idS){
			try {
				$db = config::getConnexion();
		$query = $db->prepare('UPDATE salles SET  NomS= :NomS ,NbPlaces= :NbPlaces  WHERE idS= :idS');
				$query->execute([
					'NomS' => $salles->getNomS(),
					'NbPlaces' => $salles->getNbPlaces(),
					'idS' => $idS
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

			/////..............................tri............................../////
		function triProduits(){
		$sql="SELECT * FROM produits order by NomP ASC";
		$db = config::getConnexion();
		try{
			$liste = $db->query($sql);
			return $liste;
		}
			catch(Exception $e){
			die('Erreur:'. $e->getMessage());
		}
			}

		/////..............................search............................../////
		function Recherche($nomP){
			$sql="SELECT * from salles where NomS like '".$nomP."%' ";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


		/////..............................tri............................../////
		function triSalles(){
			$sql="SELECT * FROM salles order by NomS ASC";
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
