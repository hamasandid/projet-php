<?php
use Stichoza\GoogleTranslate\GoogleTranslate;
include_once 'C:/xampp/htdocs/Cyjam/Controller/BlogC.php';

$pdo = config::getConnexion(); // Get PDO instance from config class

$sql = 'SELECT * FROM blog';
$statement = $pdo->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);

$translator = new Stichoza\GoogleTranslate\GoogleTranslate();
$translator->setSource('fr')->setTarget('en');
foreach ($people as $person) {
$person->description_en = $translator->translate($person->description);}

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
        <link rel="stylesheet" href="style copy.css">


    
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


        <section class="blog_area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
							
			<div class="row">
			<?php
                 foreach($people as $blog){
                     ?>
			 
				<div class="col-lg-4 col-md-6">
					<div class="blog_items">
						
						<div class="blog_content">
							<center> <a class="title"font size ="4" > <?= $blog->titre?></a></font></center> <br> <br>
						<center>	<img src='upload/<?= $blog->image?>' alt="" width="290px" height="200px"  ></center><br>
						<center><p><?= $blog->description?></p></center>
                        <center ><p> tranduction :<?= $blog->description_en?></p></center>
							<div class="date" style="text-align:center">
								<i class="fa fa-calendar margin-calendar" style="margin-right: 5px;" style="pading-left: 20px;" aria-hidden="true"></i><?= $blog->date?>
								
								
								
								<a href="#"><i  aria-hidden="true"></i></a>
								
								<a href="#"><i  aria-hidden="true"></i></a>
								<a href="#"><i  aria-hidden="true"></i></a>
								
								<a href="afficherpostbycom.php?id_blog=<?= $blog->id?>"><i class="fa fa-comments-o" aria-hidden="true"></i>comments </a>
							</div>
						</div>
					</div>
				</div>
				
				<?php
                 }
				?>

                       
							</div> <br>
						</div>






























<!--
        <table border="1" style=" width: 50%; height: 150px; ">
        <style>
    .description-en {
        display: none;
    }
</style>
                 <tr>
                     
                     <th style="color: gold;">Titre</th>
                     <th style="color: gold;">Description</th>

                     <th style="color: gold;">Date</th>
                     <th style="color: gold;">Image</th>
                     <th style="color: gold;">translated</th>

                     

                     
                 </tr>
                 <?php
                 foreach($people as $blog){
                     ?>
                     <tr>
                     <td style="color:black;"><?= $blog->titre?></td>
               <td style="color:black;"><?= $blog->description?></td>
               <td style="color:black; "><?= $blog->description_en?></td>
               <td style="color:black;"><?= $blog->date?></td>
                <td><img src='upload/<?= $blog->image?>' width='50'></td>
                <td> <button class="translate-button">Translate</button></td>
              
					  <style>
					  img{
						width: 90px;
                        height:	90px;					
					  }
					  
					  </style>
					  
					  </td>		
			      </tr>
                <?php
                 }
                 ?>

                </table>
                <div>
  
                
                -->   







</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        
        

          <!-- Java Script
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="traduction.js"></script>
    
   




</body>
</html>