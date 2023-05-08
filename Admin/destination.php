<?php

include_once 'C:/xampp/htdocs/Blog/Controller/BlogC.php';
include_once 'C:/xampp/htdocs/Blog/Controller/CommentaireC.php';
    //include '../config.php';
    $error = "";
	$blogC=new BlogC();
    $id=$_GET['id'];
    echo $id;
    $blog = $blogC->afficherblog();
   
    
    $listeBlogs = $blogC->afficherblog();
    
    $blog1=$blogC->recupererblogimge($id);
   
    
    $id_b=$id;
    $id_u=$id;

    
    
    ?>









<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css1/styles.css" rel="stylesheet" />
    </head>
    <section class="page-section" id="about">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Comentaires</h2>
              
            </div>
            <form action="c.php" method="POST"  >
              <input for="id_user" id="id_user" name="id_user">
              <input type="hidden" for="id_blog" id="id_blog" name="id_blog" value="<?php echo $id ?>">
                    <div class="image">
                    <?php echo "<img src='upload/{$blog1['image']}' width='140' height='140'>";
                                   
                                    ?>
                         
                          
                    <div class="timeline-panel">
                        <div class="">
                        <input type="text" id="date" name="date" value="">

<script>
  // Get the current date
  var currentDate = new Date();

  // Format the date as desired (e.g. "April 27, 2023")
  var formattedDate = currentDate.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'numeric',
    day: 'numeric'
  });

  // Update the contents of the HTML element with the formatted date
  document.getElementById("date").value = formattedDate;
</script>

                            <h4 class=""></h4>
                        </div>
                        <div class="timeline-body"><p  class="text-muted">
                         <?php 
                         
                         $blog1=$blogC->recupererblogdis($id);
                         echo $blog1['description'];
                          
                            
                        
                        
                        ?>
                        </p></div>

                    </div>
                    <br><br>
                    
                    <div>
                    <label for="commnt"><h3>Comentaires:</h3></label>
                    <input type="text"id="message" name="message" style="width: 600px ; height: 75px;" id="comment" name="comment">
                    <button type="submit" name="submit" value="Submit" > Submit</button>
                    </div>
</form>
<br><br><br>
                    <div>
                        <label for="latest"><h4>les Commentaires</h2></label>
                        <?php 
              include "config1.php";
                $stmt = $pdo->query("SELECT * FROM commentaire");
                if($stmt->rowCount() == 0){
                    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore d'employé ajouter !" ;
                    
                }else {
                    //si non , affichons la liste de tous les employés
                    while($row=$stmt->fetch()){
                        ?>
                        <ul>
                            <li>
                            <label for="foulen"><?=$row['id_user']?></label>
                            <p><h2><?=$row['message']?> </h2></p>
                            <button>LIKE</button>
                           
                            <button>DISLIKE</button>
                            <label for="foulen"><?=$row['date']?></label>




                            </li>



                        </ul>
                        <?php
                    }
                }
            ?>
                    </div>
              
              
           
            

        </div>
    </section>
    
                        
                