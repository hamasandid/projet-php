<?php
   include_once 'C:/xampp/htdocs/Cyjam/Controller/BlogC.php';
   include_once 'C:/xampp/htdocs/Cyjam/Model/Blog.php';

    $error = "";

    // create adherent
    $blog = null;

    // create an instance of the controller
    $blogC = new BlogC();
    if (
        isset($_POST["id"]) &&
		isset($_POST["titre"]) &&		
        isset($_POST["date"]) && 
        isset($_POST["description"])
    ) {
        if (
            !empty($_POST["id"]) && 
			!empty($_POST['titre']) &&
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
                 $_POST['file']=$_POST['img'];
                 echo "erreur";
             }
             //END FILE//
            $blog = new Blog(
                
				$_POST['titre'],
                $_POST['description'],
                $_POST['date'],
                $_POST['image']

				
               
            );
            $blogC->modifierblog($blog, $_POST['id']);
            header('Location:afficherblog.php');
        }
        else
            $error = "Missing information";
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles1.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
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
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                        
                        
                        
                            <div class="card-body">
            
            <!-- Widgets End -->
            <?php
			if (isset($_POST['id'])){
				$blog = $blogC->recupererblog($_POST['id']);
            
				
		?>
            <form action="" method="POST"  name="ajout">
                                       <table style="position: relative; left: 550px; top: 40px;">
                               
                                           
   <tr >
<td style="color: white; top: -42px; position: relative;"><label for="type">ID</label></td>
                                               <td style="color: white; position: relative; left: 20px; top: -50px;"><input type="number" name="id" id="id" value="<?php echo $blog['id']; ?>"></td>
                                              
                                               
                                           </tr>
                                           <tr >
                                               <td style="color: white; top: -42px; position: relative;"><label for="type">titre</label></td>
                                               <td style="color: white; position: relative; left: 20px; top: -40px;"><input type="text" name="titre" id="titre" value="<?php echo $blog['titre']; ?>"></td>
                                              
                                               
                                           </tr>
                                           
                                           <tr>
                                               <td style="color: white; position: relative; top: -32px;"><label for="date">Date</label></td>
                                               <td style="position: relative; left: 25px; top: -32px;"><input type="date" name="date" id="date" value="<?php echo $blog['date']; ?>"></td>
                                           </tr>
                                           <tr>
                                               <td style="color: white; position: relative; top: -18px;"><label for="sujet">description</label></td>
                                               <td style="position: relative; left: 25px; top: -22px;"><input type="text" name="description" id="description" value="<?php echo $blog['description']; ?>"></td>
                                           </tr>
                                           <tr> 
                                           

                                           <td style="color: white; position: relative; top: -18px;"><label for="sujet">image</label></td>
                                               <td style="position: relative; left: 25px; top: -22px;"><input type="file" name="image" id="image" value="<?php echo $blog['image']; ?>"></td>


                                       </tr>
                                         
                                           <tr>
                                               <td ><button  style="position: relative; left: 300px; top: 25px;" type="submit" >Modifier</button></td>
                                               <td><input style="position: relative; left: 118px; top: 25px;" type="reset" value="Annuler"></td>
                                           </tr>
                                      
                                      
                                     
                                 
                                       </table>
                                   </form>
                                   <?php
		}
		?>
        

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