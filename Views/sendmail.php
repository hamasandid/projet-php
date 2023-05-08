<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


//includes reclamation
include_once '../../../../Model/Films.php';
include_once '../../../../Controller/FilmsC.php';
/*
include 'C:/xamppp/htdocs/Works/Filmms/Dashboard/Config.php';
include_once 'C:/xamppp/htdocs/Works/Filmms/Dashboard/Model/Films.php';
*/
//end

if (isset($_POST["send"])){
    $mail = new PHPMailer(true);


    //creation de la reclamation 

    // create user
    $films = null;

    // create an instance of the controller
    $FilmC = new FilmC();
    if (		
        isset($_POST["NomF"]) &&
        isset($_POST["Duree"]) &&
        isset($_FILES["video"]) && 
        isset($_POST["descriptionn"]) &&
        isset($_POST["NomS"]) &&
        isset($_POST["NbPlaces"]) 
    
        
    ){
        if ( !empty($_POST["NomF"]) &&  !empty($_POST["Duree"])  &&  !empty($_FILES["video"]) && !empty($_POST["descriptionn"])&& !empty($_POST["NomS"])&& !empty($_POST["NbPlaces"]))
        {   
            $filename = $_FILES["video"]["name"];
            $tempname = $_FILES["video"]["tmp_name"];
            $folder = "./image/" . $filename;
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Video uploaded successfully!</h3>";
            } else {
                echo "<h3>  Failed to upload video!</h3>";
            }
    
            $films = new Film(
                $_POST['NomF'], 
                $_POST['Duree'],
                $filename,
                $_POST['descriptionn'],
                $_POST['NomS'],
                $_POST['NbPlaces'],
            );
            $FilmC->AjouterFilm($films);            
            error_log("success");
           //  header("Location:AfficherFilm.php?successMessage= Film ajouté avec succés");
            
    
            
            
        }
        else
            $errorMessage = "<label id = 'form' style = 'color: red; font-weight: bold;'>&emsp;Une Information manquant !</label>   ";
            
            
    }   


    //end 

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com' ; 
$mail->SMTPAuth = true ; 
$mail->Username = 'gestionfilmss@gmail.com' ; // your gmail
$mail->Password = 'jhrlggmwqczwtemq' ; // your gmail app passwords
$mail->SMTPSecure = 'ssl' ; 
$mail->Port = 465 ; 


$mail->setFrom('Sassiyasmine02@gmail.com');
$mail->addAddress('gestionfilmss@gmail.com');
$mail->isHTML(true);


$mail->Subject = 'Gestion des Films' ; 
$mail->Body = ' Nouveau Film est ajouté avec succés !' ;


$mail->send();


echo
"
<script>
alert('Email Sent Successfully');
document.location.href = 'AjouterFilm.php';
</script>
";
}
?>
