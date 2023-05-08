<?php
require_once 'C:/xampp/htdocs/Cyjam/vendor/autoload.php';
include_once 'C:/xampp/htdocs/Cyjam/Config.php';
include_once 'C:/xampp/htdocs/Cyjam/Model/Commentaire.php';


class ReponseC{

    
    function affichercommentaire(){
        $sql="SELECT c.id , c.message , c.date ,p.titre FROM commentaire c JOIN blog p ON c.id_blog = p.id";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    }
    function ajoutercommentaire($commentaire){
        $sql="INSERT INTO  commentaire ( id_blog, message,id_user, date) 
        VALUES (:id_blog,:message, :id_user, :date )";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                
                'id_blog' => $commentaire->getIdBlog(),
                'message' => $commentaire->getmessage(),
                'id_user' => $commentaire->getIdUser(),
                'date' => $commentaire->getdate()
               
                
            ]);			
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }			
    }
    function recuperercommentaire($Id){
        $sql="SELECT * from commentaire where id=$Id";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $commentaire=$query->fetch();
            return $commentaire;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function modifiercommentaire($commentaire, $Id){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE commentaire SET 
                    
                    id_blog= :id_blog, 
                    message= :message, 
                    id_user= :id_user, 
                    date=:date
                WHERE id= :id'
            );
            $query->execute([
                'id' => $Id,
                'id_blog' => $commentaire->getIdBlog(),
                'message' => $commentaire->getmessage(),
                'id_user' => $commentaire->getIdUser(),
                'date' => $commentaire->getdate(),
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function supprimercommentaire($Id){
        $sql="DELETE FROM commentaire WHERE id=:Id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':Id', $Id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}

    }
    

}

?>