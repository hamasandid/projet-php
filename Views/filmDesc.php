
<?php

	include 'C:/xampp/htdocs/Cyjam/Controller/FilmsC.php';
 
  session_start();

if(!isset($_SESSION['idclient']))
{

    header("location: Connexion.php");
}

 
$FilmC=new FilmC();
  if (isset($_GET['id'])) {
  
    $id=$_GET['id'];
    $films = $FilmC->RecupererFilm($id); 
    $id_user = 1;

    //incrementing the views of the movie
  $sql="SELECT * from video_views where film_id=$id";
	$db = config::getConnexion();
			
	$query=$db->prepare($sql);
	$query->execute();

	$filmviews=$query->fetch();
	
  $views=$filmviews['views']+1;
  $viewId=$filmviews['id'];
  
  $queryy = $db->prepare('UPDATE `video_views` SET `views`=:views WHERE `id`= :id');
				$queryy->execute([
					'views' => $views,
					'id' => $viewId,
				]);
			

  //end increment
  }

  
  if(isset($_POST['message'])){
  // Get message and user ID from POST request

  $message = $_POST['message'];
  $user_id = $_POST['user_id'];
  $film_idd =$_POST['film_id'];
  // Get the current date and time
  $date = date('Y-m-d H:i:s');


  // Insert message into database
  $sql="INSERT INTO `chat_messages`( `user_id`, `message`,`film_id`,`created_at`) VALUES (:user_id,:messagee,:film_id,:datee)";
			
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'user_id' => $user_id,
					'messagee' => $message,
          'film_id' => $film_idd,
          'datee' => $date,
			]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}		

  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $user_id = $_POST['user_id'];
    // Process the message as needed here
    echo json_encode(array('message' => $message, 'user_id' => $user_id));
    exit;
}


?>

<html>
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
        <link rel="stylesheet" href="styleJAS.css">
    <style>
        #chat_load {
            height: 600px;
            overflow: scroll;
        }
        #chatheader {
          font-size: 24px;
          background: #1F3BB3;
          color: #fff;
          border-radius: 10px 10px 0 0;
          padding: 7px;
          margin-bottom: 10px;
        }
        .messageinput{
            border-radius:10px;
            border:2px solid #eee;
            width:80%;
        }
        .messagebtn{
          background: #1F3BB3;
          color: #fff;
          border-radius: 10px;
          padding: 7px;
          border:none;
        }
    </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </header>
    <body>
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
        <main class="line1">
       
        <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
                <div class="col-8">
                <div class="card-title"><?php echo $films['NomF']; ?></div>
                      <div><?php echo $films['Duree']; ?></div>
                      <div><video width="100%" height="auto" poster="image/logo.jpg" controls>
                      <source src="../../../back/pages/Films/image/<?php echo $films['video']; ?>" type="video/mp4">
                      <source src="../../../back/pages/Films/image/<?php echo $films['video']; ?>" type="video/ogg">
                      </video>
                      </div>
                      <div><?php echo $films['descriptionn']; ?></div>
                      <div><?php 	
                      $salle = $FilmC->RecupererSalle($films['idS']); /*Recuperation categorie par id dans une variable category*/
                      $nomS=$salle['NomS'];
                      echo $nomS;?></div>
                      <div><?php 	
                      $salle = $FilmC->RecupererSalle($films['idS']); /*Recuperation categorie par id dans une variable category*/
                      $nbplaces=$salle['NbPlaces'];
                      echo $nbplaces;?></div>

                </div>
                    <div class="col-4">

                              <!-- film chat  -->
                              <input type="hidden" id="filmId" value="<?php echo $id; ?>">
                                    <input type="hidden" id="send" value="<?php echo $id_user; ?>"> 
                                    <div id="chatheader">Chat Section</div>
                                    <div id="chat_load"></div>
                                    <script type="text/javascript">
                                    $(function(){
                                      const receive = $('#filmId').val(); 
                                      const send    = $('#send').val(); 
                                      const dataStr = 'receive='+receive+'&send='+send;
                                      setInterval(function(){
                                        $.ajax({
                                          type:'GET',
                                          url:'chat_loader.php',
                                          data:dataStr,
                                          success:function(e){
                                            $('#chat_load').html(e);
                                          }
                                        });   
                                      }, 100);
                                    });
                                    </script>

                                    <br>
                                    <input type="text" id="chat-message" class="messageinput" placeholder="type something...">
                                    <button onclick="sendChatMessage()" class="messagebtn">Send</button>
                                    <input type="hidden" id="film" value="<?php echo $films['idFilm']; ?>"> 
                                    <script type="text/javascript"> 
                                  

                                      // Send chat message to server
                                      function sendChatMessage() {
                                            var message = document.getElementById('chat-message').value;
                                            var film_id = document.getElementById('film').value;
                                            var user_id = 1; // Get user ID from somewhere
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', '<?php echo $_SERVER['PHP_SELF']; ?>', true);
                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                            xhr.send('message=' + message + '&user_id=' + user_id+ '&film_id=' + film_id);
                                            document.getElementById('chat-message').value = '';
                                        }
                                      
                                    </script>
                                <!-- film chat end -->
                    </div>
                                    </div>
                                    </div>
</div>
				    
        
        </main>
    </body>
</html>