<?php
	include 'C:/xampp/htdocs/Cyjam/Controller/SallesC.php';


	$SalleC=new SalleC();


	$listeSalles = isset($_GET['search']) ? $SalleC->Recherche($_GET['search']) : (isset($_GET['tr']) ? $SalleC->triSalles() : $SalleC->AfficherSalle());


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
        <link rel="stylesheet" href="css/home.css">



    
        <!-- favicons
        ================================================== -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/LOGO.jpg">

        <include type="text/html" data="index.html">


    
    </head>

    <body >

        <!-- # site header 
        ================================================== -->

        <nav>
            <img src="images/logo.jpg">
        <a  class="navA" href="home.html">Home</a>
        <a  class="navA" href="MyProfile.php#testimonials">My profile</a>
        <a  class="navA" href="jessem/index.html">Produits</a>
        <a class="navA">Cinéma</a>
        <a class="navA">Reservations</a>
        <a  class="navA" href="afficherblog.php">Actualité</a>
        <a  class="navA" href="Deconnexion.php#sign">Deconnexion</a>
        </nav>



        <!-- # site-content
        ================================================== -->
        <section id="content" class="s-content">



            <!-- testimonials
            ----------------------------------------------- -->
            
        <main class="line1">
        <?php
			foreach($listeSalles as $salles){
		?>
            <div class="shadow">
                <img src="salle.jpg">
                <h4><?php echo $salles['NomS']; ?></h4>
                <h5>Nombre des places : <?php echo $salles['NbPlaces']; ?><br><a  href="films.php?id=<?php echo $salles['idS']; ?>">regarder un film</a></h5>
                
            </div>
        <?php
            }
        ?>
        </main>
    </body>
</html>