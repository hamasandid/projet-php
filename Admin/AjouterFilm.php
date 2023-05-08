<?php
include_once 'C:/xampp/htdocs/Cyjam/Controller/FilmsC.php';





$errorMessage = "";
$successMessage = "" ;






// create user
$films = null;

// create an instance of the controller
$FilmC = new FilmC();
if (		
    isset($_POST["NomF"]) &&
    isset($_POST["Duree"]) &&
    isset($_FILES["video"]) && 
    isset($_POST["descriptionn"]) &&
    isset($_POST["NomS"]) &&
    isset($_POST["NbPlaces"]) 

    
){
    if ( !empty($_POST["NomF"]) &&  !empty($_POST["Duree"])  &&  !empty($_FILES["video"]) && !empty($_POST["descriptionn"])&& !empty($_POST["NomS"])&& !empty($_POST["NbPlaces"]))
    {   

      // Upload video fi dossier esmou image
        $filename = $_FILES["video"]["name"];
        $tempname = $_FILES["video"]["tmp_name"];
        $folder = "./image/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Video uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload video!</h3>";
        }
        // end 

        $films = new Film(
            $_POST['NomF'], 
            $_POST['Duree'],
            $filename,
            $_POST['descriptionn'],
            $_POST['NomS'],
            $_POST['NbPlaces'],
        );
        $FilmC->AjouterFilm($films);
        header("Location:AfficherFilm.php?successMessage= Film ajouté avec succés");

        
        
    }
    else
        $errorMessage = "<label id = 'form' style = 'color: red; font-weight: bold;'>&emsp;Une Information manquant !</label>   ";       
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
                            <a class="nav-link" href="afficherListeReclamation.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Reclamations
                            </a>
                            <a class="nav-link" href="liste_reservation.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Reservations
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>


                        <!-- form -->
                        
                        <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                            <form method="post" class="form" action="sendmail.php" name="form"  id="form" enctype="multipart/form-data" onsubmit=" return validateForm();">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Ajouter Film</h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row mb-3">

                                                <!--------------------------------------------NomF ------------------------------------------------->
<div class=" input-group mb-3 ">
    <label class="col-sm-3 col-form-label ">Nom Film</label>
    <div class="col-sm-6">
        <input type="text" class="form-control"  name="NomF" id="NomF"  placeholder= "Nom Film">
        <div id="nomf-error" class="error-message"></div>
    </div>
</div>


                                                <div class="input-group mb-3">
<label class="col-sm-3 col-form-label ">Durée</label>
    <div class="col-sm-6">
        <input type="time" class="form-control" name="Duree" id="Duree"  placeholder= "Durée"  >
    </div>
</div>

<!---------------------------------------------img---------------------------------------------->
    <div class="input-group mb-3">
        <label class="col-sm-3 col-form-label ">Vidéo</label>
          <div class="col-sm-6">
        <input type="file" class="form-control" name="video" id="video" required >
    </div>
</div>

<!---------------------------------------------Description---------------------------------------------->
<div class="input-group mb-3">
    <label class="col-sm-3 col-form-label ">Description</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="descriptionn" id="descriptionn" placeholder= "Description" >
        <div id="desc-error" class="error-message"></div>
    </div>
 </div>
    <!---------------------------------------------Nom salle---------------------------------------------->
<div class="input-group mb-3">
        <label class="col-sm-3 col-form-label ">Nom Salle</label>
          <div class="col-sm-6">
            <select id="    " name="NomS"  class="form-control"  >
            <?php 
            //récuperer la liste des categories 
            function AfficherSalle(){
                $sql="SELECT * FROM salles";
                $db = config::getConnexion();
                try{
                    $liste = $db->query($sql);
                    return $liste;
                }
                catch(Exception $e){
                    die('Erreur:'. $e->getMessage());
                }
            }

          $listeSalles=AfficherSalle();
            foreach($listeSalles as $salles){ 
            ?>
            <option value="<?php echo $salles['idS']; ?>" class="form-control" ><?php echo $salles['NomS']; ?></option>    
            <?php
            //fin foreach 
            }
            ?>
                </select>
        
            </div>
            </div> 
         <!---------------------------------------------Nombre des places---------------------------------------------->
         <div class="input-group mb-3">
        <label class="col-sm-3 col-form-label ">Nombre Places</label>
          <div class="col-sm-6">
            <select id="salleId" name="NbPlaces"  class="form-control"  >
            <?php 

          $listeSalles=AfficherSalle();
            foreach($listeSalles as $salles){ 
            ?>
            <option value="<?php echo $salles['idS']; ?>" class="form-control" ><?php echo $salles['NbPlaces']; ?></option>    
            <?php
            //fin foreach 
            }
            ?>
                </select>
        
    </div>
</div> 

<!---------------------------------------------Buttons---------------------------------------------->



                                            </div>
                                            
                                        
                                            <div class="mt-4 mb-0">
                                            <div class="row mb-5">
                                            <div class="offset-sm-3 col-sm-3 d-grid">
                                                <button  type="submit" class="btn btn-primary" name = "send"  id ="send">Ajouter</button>
                                            </div>
                                            <div class="col-sm-3 d-grid">
                                                <a class="btn btn-primary" href="AfficherFilm.php" role="button">Retour</a>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>


                    
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/chart-area-demo.js"></script>
        <script src="../../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../../js/datatables-simple-demo.js"></script>
    </body>
</html>
