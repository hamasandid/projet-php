<?php
	include '../config.php';
	include_once '../Model/Reclamation.php';
	class ReclamationC {
		function afficherreclamation(){
			$sql="SELECT * FROM reclamation";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}
		function supprimerreclamation($id){
			$sql="DELETE FROM reclamation WHERE id=:id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}
		function ajouterreclamation($reclamation){
			$sql="INSERT INTO reclamation (nomclient ,cin,email, texte) 
			VALUES (:nomclient,:cin,:email,:texte)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'nomclient' => $reclamation->getnomclient(),
					'cin' => $reclamation->getcin(),
					'email' => $reclamation->getemail(),
					'texte' => $reclamation->gettexte()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recupererreclamation($id){
			$sql="SELECT * from reclamation where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$reclamation=$query->fetch();
				return $reclamation;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifierreclamation($reclamation,$id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					"UPDATE reclamation SET 
					    email= :email,
						cin= :cin,
						texte= :texte
					WHERE id= '$id'"
				);
				$query->execute([
					'email' => $reclamation->getemail(),
					'cin' => $reclamation->getcin(),
					'texte' => $reclamation->gettexte()
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}
?>