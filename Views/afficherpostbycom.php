<?php
use Stichoza\GoogleTranslate\GoogleTranslate;
include_once 'C:/xampp/htdocs/Cyjam/Controller/BlogC.php';
include_once 'C:/xampp/htdocs/Cyjam/Model/Commentaire.php';

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
        

        
	

	
	<?php
	// Check if a post ID was passed in the URL
	if (isset($_GET['id_blog'])) {
		$id_blog = $_GET['id_blog'];
		
		// Fetch the post from the database
		// (You will need to modify this code to match your database schema)
		$pdo = config::getConnexion();
		$stmt = $pdo->prepare("SELECT * FROM blog WHERE id = :id_blog");
		$stmt->bindParam(':id_blog', $id_blog);
		$stmt->execute();
		$blog = $stmt->fetch(PDO::FETCH_ASSOC);


        
		?>
        
<section class="about_us_area section_gap_top">
			<div class="container">
				<div class="row about_content align-items-center">
					
						<div class="section_content">
						<?php
		if ($blog) {
           ?> 
                       
						
                       <center> <h2 style="color:white;margin-right: 300px;">  <?php echo $blog['titre']; ?></h2></center> <br> <br>
						<center>	 <?php echo "<td margin-right: 300px;><img src='upload/{$blog['image']}' style='margin-right: 300px;' width='300px' height='300px'></td>";
                                    echo "<td>";
                                    ?><br>
						<center><h2 style="color:white;margin-right: 300px;"><?php echo $blog['description']; ?></h2></center>
							
						
					
							
			
            
			
			





<?php
        }

        



        
        $stmt = $pdo->prepare("SELECT * FROM commentaire WHERE id_blog = :id_blog");
        $stmt->bindParam(':id_blog', $id_blog);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <br><br>
        <h3 style="margin-right: 800px;">liste of comments</h3>
        <?php
        foreach ($comments as $comment) {
            ?>
           <center> <h2 style="margin-right: 800px;color:grey" >  <?php echo $comment['id_user']; ?></h4>
            <center> <h4 style="margin-right: 800px;margin-top:10px" >  <?php echo $comment['message']; ?></h4>
            
            <?php
        }
        $message = '';
if (isset ($_POST['id_blog']) && isset($_POST['id_user'])    && isset($_POST['message'])   ) {
  $id_blog = $_POST['id_blog'];
  $id_user = $_POST['id_user'];
  $message = $_POST['message'];
  
  
  $sql = 'INSERT INTO commentaire(id_blog, id_user, message) VALUES(:id_blog, :id_user, :message)';
$statement = $pdo->prepare($sql);
$statement->bindParam(':id_blog', $id_blog);
$statement->bindParam(':id_user', $id_user);
$statement->bindParam(':message', $message);
if ($statement->execute()) {
  $message = 'data inserted successfully';
  
}
}
?>
        



			
			
			<form method='post'  style="margin-right: 800px;">
    <input type='hidden' name='id_blog' value='<?php echo htmlspecialchars($id_blog); ?>'>
    <input type='hidden' name='id_user' value='<?php echo ("ayoub"); ?>'>
    <textarea  placeholder='veuillez saisir in commentaire' name='message'></textarea><br>
    <input type='submit' value='Submit'>
</form>
			
            
		<?php	
         
		}
	?>
</body>
</html>

        