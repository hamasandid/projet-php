<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'C:/xampp/htdocs/Cyjam/vendor/autoload.php';
include_once 'C:/xampp/htdocs/Cyjam/Config.php';//adheya taamlou include bch yaamelek connexion maa lbase de donnée
//include_once 'G:/xampp/htdocs/Blog/Blog/Model/Blog.php';//bch yaamel appel lel entitié Blog 

class BlogC{
//affichage
    function afficherblog(){
        $sql = "SELECT * FROM blog";
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql .= " WHERE titre LIKE '%$search%'";
}//bch yemchi yjib les blogs eli mawjoudin fel base de données lkol //hedhi requéte 
        $db = config::getConnexion();
       
        try{
            $query=$db->prepare($sql);//bch yaamel préparation lel requete 
            $query->execute();// bch yaamel exécution lel requete 
            

            $liste = $db->query($sql);//bch y7ot les blogs lkol fi variable esmha liste(tableau)

            return $liste; //yraj3ou tableau adheka 
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    }
    //ajouter
    function ajouterblog($blog){
        //$blog=bch y3amerha mel formulaire enti aandek formulaire mte3 ajout w bch t3amrou bch tssir récuperation mte3 les données eli enti 3amarthom baaed 
        // tetesna3 instance Blog $blog=new Blog() w bch thott fel titre w description wela image w .... les valeurs mte3 lforumlaire 
        $sql = "INSERT INTO blog (titre, description, date,image) VALUES (:titre, :description, :date_post,:image)";
        //
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $blog->gettitre(),
                'description' => $blog->getdescription(),
                'date_post' => $blog->getdate(),
                'image' => $blog->getimage()
            ]);	
            $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'marzoukghassen6@gmail.com';
  $mail->Password = 'pfnjxaziowgavfeh';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->setFrom('marzoukghassen6@gmail.com');
  $mail->addAddress('ayoub.hanfi@esprit.tn');
  
  
  // Set up email
  $mail->Subject = 'new blog';
  $mail->Body = 'new blog just posted go check it';
  
  // Send the email
  $mail->send();					
        } catch (Exception $e) {
            echo 'Erreur: '.$e->getMessage();
        }

    }

    //adheya kima l'affichage juste tefra9 bel where bch yjib blog mou3ayen
    function recupererblog($Id){
        $sql="SELECT * from blog where id=$Id";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $blog=$query->fetch();
            return $blog;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function recupererblogimge($Id){
        $sql="SELECT image from blog where id=$Id";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $blog=$query->fetch();
            return $blog;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function recupererblogdis($Id){
        $sql="SELECT description from blog where id=$Id";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $blog=$query->fetch();
            return $blog;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    //modifier
    function modifierblog($blog, $Id){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE blog SET 
                    titre= :titre, 
                    description= :description,
                    date= :date_post,
                    image= :image
                    WHERE id= :id'
            );
            //houni 3ibara 9otlou badel lblog eli 3andou id 15 
            $query->execute([
                'id' => $Id,
                'titre' => $blog->gettitre(),
                'description' => $blog->getdescription(),
                'date_post' => $blog->getdate(),
                'image' => $blog->getimage(),
                
                
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function supprimerblog($Id){
        $sql="DELETE FROM blog WHERE id=:Id";
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