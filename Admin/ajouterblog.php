<?php

include_once 'C:/xampp/htdocs/Cyjam/Controller/BlogC.php';
include_once 'C:/xampp/htdocs/Cyjam/Model/Blog.php';

$error = "";
$blog=null;
$blogC= new BlogC();// bch yasna3 instance mn Controlleur mte3 lblog eli houwa BlogC

if (
    
    
    isset($_POST["titre"]) &&		//bch ytesti idha ken fama champ esmou titre w idha ken wsellou
    isset($_POST["date"]) && 
    isset($_POST["description"]) 
    
) {
    if (
        
        !empty($_POST["titre"]) && //idha ken champ titre ma 93adech feregh w m3amer
        !empty($_POST["date"]) &&
        !empty($_POST["description"]) 
     
        
        
    ) {
       
         //START FILE//
         $tmpName = $_FILES['image']['tmp_name'];
         $name = $_FILES['image']['name'];
         $size = $_FILES['image']['size'];
         $error = $_FILES['image']['error'];
         $type = $_FILES['image']['type'];

         $tabExtension = explode('.', $name);
         $extension = strtolower(end($tabExtension));

         $extensionsAutorisees = ['jpg', 'png', 'jpeg', 'gif'];
         $tailleMax = 400000;

         if(in_array($extension, $extensionsAutorisees) && $size <= $tailleMax && $error == 0){
             $_POST['image'] =$_FILES['image']['name'];

             move_uploaded_file($tmpName, './upload/'.$name);
         }
         else{
             echo "erreur";
         }
         //END FILE//
        
    
   
          $blog = new Blog(
          $_POST['titre'],
          $_POST['description'], 
          $_POST['date'],
          $_POST['image']//yasna3 instance mel blog w y7ott fiha les données mte3 lformulaire 3an tri9 lconstructeur 
          

        
          
      );
     
      $blogC->ajouterblog($blog);

      header('Location:afficherblog.php');//thezel lel page mte3 l'affichage
  
  }
}
    else
        $error = "Missing information";
 ?>
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
       
        <link href="css/styles1.css" rel="stylesheet" />
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">TUNICULTE</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
               
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="Deconnexion.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <!-- sidebar -->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="AfficherUsers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                user
                            </a>
                            <a class="nav-link" href="afficherblog.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                blogs
                            </a>
                            <a class="nav-link" href="affichercom.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                comments
                            </a>
                            <a class="nav-link" href="afficherListeReclamation.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Reclamations
                            </a>
                            <a class="nav-link" href="liste_reservation.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Reservations
                            </a>
                            <a class="nav-link" href="indexproduit.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Produits
                            </a>
                            <a class="nav-link" href="indexfacture.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Facture
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Salles
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="AfficherSalles.php">Afficher Salles</a>
                                    <a class="nav-link" href="AjouterSalle.php">Ajouter Salle</a>
                                    <a class="nav-link" href="AfficherFilm.php">Afficher films</a>
                                    <a class="nav-link" href="AjouterFilm.php">Ajouter film</a>

                                </nav>
                            </div>
                            
                
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                        
                        
                        
                            <div class="card-body">

                                
        
        
      <br><br>
         <br> 
         <center><h1>Create Blog </h1></center> <br>
            <!-- Widgets End -->
           <center> <form action="ajouterblog.php" method="POST"  name="ajout" enctype="multipart/form-data">
                                       
                                     

                                           <tr >
                                               <td style="color: white; top: -42px; position: relative;"><label for="type">titre</label></td>
                                               <td style="color: white; position: relative; left: 20px; top: -40px;"><input type="text" name="titre"  id="titre" onkeypress="return validateChar(event)">
                                              
                                               
                                           </tr>
                                           <br> <br>
                                           <tr>
                                               <td style="color: white; position: relative; top: -32px;"><label for="date">Date</label></td>
                                               <td style="position: relative; left: 25px; top: -32px;"><input type="date" name="date" id="date"></td>
                                           </tr>
                                           <br> <br>
                                           <tr>
                                               <td style="color: white; position: relative; top: -18px;"><label for="sujet">description</label></td>
                                               <td style="position: relative; left: 25px; top: -22px;"><input type="text" name="description" id="description" onkeypress="return validateChar(event)"></td>
                                           </tr>
                                           <br> <br>
                                           <tr>
                                           <div class="form-group">
                    <input type="file" id="icon" class="fas fa-image"  name="image" >
            </div>
                                           </tr>
                                           <br> <br>
                                           <tr>
                                               <td ><button  class="btn btn-primary" style="background-color:red; " type="submit" >Envoyer</button></td>
                                               <td><input class="btn btn-primary" style="background-color:red;" type="reset" value="Annuler"></td>
                                           </tr>
                                     
                                 
                                      
                                   </form> </center>
                                   <br> <br> <br>  <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <?php include'footer.php'  ?>

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://unpkg.com/chart.js@3.7.0/dist/chart.min.js"></script>
        <script src="pdf.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="pdf.js"></script>
</body>

</html>