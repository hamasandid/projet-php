<?php

include "../Model/client.php";
include "../Controller/ClientC.php";

if(isset($_POST['Submit']))
{
   $email=$_POST["email"];
   $clientC = new ClientC();

    $liste=$clientC->recupereremail($email);
     foreach($liste as $row){
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
    }
  if($nom!="")
  {
   $token="azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLM1234567890";
   $token=str_shuffle($token);
   $token=substr($token,0,10);
   echo $token;
   $clientC->ajouterClientToken($email,$token);
   header("location: journal/sendmail.php?email=".$email."&token=".$token);
  }
  else
   {
    echo "<script type='text/javascript'>";
    echo "alert('Email not registered');
    window.location.href='ForgetPassword.php';";
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
        <link rel="stylesheet" type="text/css" href="css/home.css">

    
        <!-- favicons
        ================================================== -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/LOGO.jpg">
        <link rel="manifest" href="site.webmanifest">

        <include type="text/html" data="index.html">


    
    </head>

    <body id="top" class="ss-show">
        <div id="preloader" style="display: none;">
            <div id="loader">
            </div>
        </div>
    <div id="page" class="s-pagewrap">

        <!-- # site header 
        ================================================== -->
        <html>
    
    <body>
    <nav>
            <img src="images/LOGO.jpg"style="height:100px;width:100px;margin-right:900px;" >
            <a  class="navA" href="SignUp.php#subscribe">Créer nouveau Compte</a>
            <a  class="navA" href="SignIn.php#sign">Connexion</a>
        </nav>
       

        

        <div class="main">

        <section class="sign-in" id="sign">
        <div class="container">
        <div class="signin-content">
        <div class="signin-image">
        <figure><img src="images/LOGO.jpg"style="height:300px;width:300px;" alt="sing up image"></figure>
        <a href="SignUp.php#subscribe" class="signup-image-link">Créer un nouveau compte</a>
        <a href="SignIn.php#sign" class="signup-image-link">Connexion ?</a>
        </div>
        <div class="signin-form">
        <h2 class="form-title">Mot de passe oublié?</h2>
        <form action="#" class="login-form__form" method="post" enctype="multipart/form-data" >

        <div class="form-group">
            <label for="id_2" id="icon"><i class="fas fa-envelope"></i></label>
            <input type="email" name="email" placeholder="Email"  class="no-outline" />
        </div>


        <div class="btn-block">
        <button type="submit" name="Submit" id="Submit">Envoyer</button>
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
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>