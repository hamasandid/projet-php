<?php
	include 'C:/xampp/htdocs/Cyjam/Controller/FilmsC.php';

 
	$FilmC=new FilmC();
    $id=$_GET['id'];
    $listeFilms = $FilmC->RecupererFilmParSalle($id); 

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
        <a class="navA" href="salles.php" >Cinéma</a>
        <a class="navA">Reservations</a>
        <a  class="navA" href="afficherblog.php">Actualité</a>
        <a  class="navA" href="Deconnexion.php#sign">Deconnexion</a>
        </nav>



        <!-- # site-content
        ================================================== -->
        <section id="content" class="s-content">



            <!-- testimonials
            ----------------------------------------------- -->
           
        <?php
			foreach($listeFilms as $film){
		?>
            <div class="shadow">
                <img src="salle.jpg">
                <h4><?php echo $film['NomF']; ?></h4>
                <h5>Durée: <?php echo $film['Duree']; ?><br><?php echo $film['descriptionn']; ?></h5><br>
                <h5><a href="filmDesc.php?id=<?php echo $film['idFilm']; ?>">watch film</a></h5>
                
            </div>
        <?php
            }
        ?>
        </main>
    </body>
</html>