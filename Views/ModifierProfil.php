<?php 

session_start();

if(!isset($_SESSION['idclient']))
{

    header("location: SignIn.php");
}

include "../Model/Client.php";
include "../Controller/ClientC.php";


$clientC = new ClientC();
$result=$clientC->recupererClient($_GET['id']);
foreach($result as $row){
    $id=$row['id'];
    $nom=$row['nom'];
    $prenom=$row['prenom'];
    $email=$row['email'];
    $mdp=$row['mdp'];
    $tel=$row['tel'];
    $adresse=$row['adresse'];
    $sexe=$row['sexe'];
    $date_naiss=$row['date_nais'];
    $image=$row['image'];
    $role=$row['role'];
    $statut=$row['statut'];
    }



    if(isset($_POST['Modifier']))
    {
    if( isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email']) and isset($_POST['mdp']) and isset($_POST['tel']) and isset($_POST['adresse'])){
    $client=new Client($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['mdp'],$_POST['tel'],$_POST['adresse'],$_POST['sexe'],$_POST['date_nais'],$role,$statut);
    
        $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
    
        $folder = "./images/client/".$filename ;
                    if($filename!="")
            {
        move_uploaded_file($tempname, $folder);
        $clientC->ajouterClientimg($_POST['email'],$folder);
                 $_SESSION['clientimage'] = $folder;
    
        }
    
    //Partie3
        if($_POST['mdp'] != "")
        {
            $clientC->modifierClientPwd($client,$_GET['id']);
        }
        else
        {
            $clientC->modifierClient($client,$_GET['id']);
        }
             $_SESSION['client'] = $_POST['nom'] ." ".$_POST['prenom'];
             $_SESSION['clientemail'] = $_POST['email'];
             $_SESSION['clienttel'] = $_POST['tel'];
             $_SESSION['clientadresse'] = $_POST['adresse'];
             $_SESSION['clientsexe'] = $_POST['sexe'];
             $_SESSION['clientdate_naiss'] = $_POST['date_nais'];

header('Location: MyProfile.php');
    
}  
 else
{
 echo "<script type='text/javascript'>";
 echo "alert('Check fields');
 window.location.href='ModifierProfil.php';";
 echo "</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>
        <!--- basic page needs
        ================================================== -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cyjam</title>
    
        <script>
            document.documentElement.classList.remove('no-js');
            document.documentElement.classList.add('js');
        </script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/style.css">


    
        <!-- favicons
        ================================================== -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/LOGO.jpg">

        <include type="text/html" data="index.php">


    
    </head>

    <body id="top" class="ss-show">
        <div id="preloader" style="display: none;">
            <div id="loader">
            </div>
        </div>
    <div id="page" class="s-pagewrap">

        <!-- # site header 
        ================================================== -->

        
        

        <div class="main">

            <section class="signup" id="subscribe">
            <div class="container">
            <div class="signup-content">
            <div class="signup-form">
            <h2 class="form-title">Edit Profile</h2>
            <form action="#" class="login-form__form" method="post" enctype="multipart/form-data" id="form_client">

            <div class="form-group" >
                <label for="id" id="icon"><i class="fas fa-user-alt"></i></label>
                <input type="text" name="nom" placeholder="Nom" id="nom" class="no-outline" value="<?PHP echo $nom ?>" />

            </div>

            <div class="form-group" >
            <label for="name" id="icon"><i class="fas fa-user-alt"></i></label>
            <input type="text" name="prenom" placeholder="Prenom" id="prenom" class="no-outline" value="<?PHP echo $prenom ?>" />
            </div>

            <div class="form-group" >
                <label for="email" id="icon" ><i class="fas fa-envelope"></i></label>
                <input type="text" name="email" placeholder="Email" id="email" class="no-outline" value="<?PHP echo $email ?>" />
            </div>

            <div class="form-group" >
                <label for="password" id="icon"><i class="fas fa-lock"></i></label>
                <input type="password" name="mdp" placeholder="Mot de passe" id="mdp" class="no-outline"  />
            </div>

            <div class="form-group" >
            <label for="phone" id="icon"><i class="fas fa-phone " class="control-label"></i></label>
            <input type="text" name="tel" placeholder="Telephone" id="tel" class="no-outline" value="<?PHP echo $tel ?>" />
            </div>
            <div class="form-group">
            <label for="adress" id="icon"><i class="fas fa-home"></i></label>
            <input type="text" name="adresse" placeholder="Adresse" id="adresse"  class="no-outline" value="<?PHP echo $adresse ?>" />
            </div>

            <div class="form-group" >
                <label for="dob" id="icon" ><i class="fas fa-calendar-alt"></i></label>
                <input  type="date" name="date_nais" id="date_nais"  class="no-outline" value="<?PHP echo $date_naiss ?>" />
            </div>
            <div class="form-group">
            <label for="image" id="icon" ><i class="fas fa-image"></i></label>
                    <input type="file"  id="image" name="image" >
            </div>

            <?PHP if($sexe=="Male"){ ?>
            <div class="form-group">
               <label class="label-agree-term">
               <label for="sexe" id="icon" ><i class="fas fa-male"></i></label>
                  <input checked type="checkbox" name="sexe" id="sexe" class="agree-term" value="Male">
                     <span class="label-text">Male</span>
                </label>
                
                <label class="label-agree-term" >
                <label for="sexe" id="icon" ><i class="fas fa-female"></i></label>
                  <input type="checkbox" name="sexe"  id="sexe" value="Female">
                     <span class="label-text">Female</span>
                </label>
    
            </div>
            <?php }else {?>
                <div class="form-group">
               <label class="label-agree-term">
               <label for="sexe" id="icon" ><i class="fas fa-male"></i></label>
                  <input  type="checkbox" name="sexe" id="sexe" class="agree-term" value="Male">
                     <span class="label-text">Male</span>
                </label>
                
                <label class="label-agree-term" >
                <label for="sexe" id="icon" ><i class="fas fa-female"></i></label>
                  <input checked type="checkbox" name="sexe"  id="sexe" value="Female">
                     <span class="label-text">Female</span>
                </label>

            <?php } ?>
            
            <div class="btn-block">
            <button type="submit"  name="Modifier" id="Modifier">Edit</button>
            </div>
            </form>
            </div>

            </div>
            </div>
            </section>

</div>

        <!-- # site-footer
        ================================================== -->
    

    <!-- Java Script
    ================================================== -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script src="js/ClientModif.js"></script>

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>