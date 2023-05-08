<?php
    include_once '../../../../Model/Films.php';
    include_once 'C:/xampp/htdocs/Cyjam/Controller/FilmsC.php';
    


    $error = "";
    $mess = "" ; 


    // create user
    $films = null;

    // create an instance of the controller
    $FilmC = new FilmC();
    if (		
        isset($_POST["NomF"]) &&
		    isset($_POST["Duree"]) && 
        isset($_FILES["video"]) && 
        isset($_POST["descriptionn"] )&&
        isset($_POST["NomS"] )&&
        isset($_POST["NbPlaces"] )) 
        {
        if (			
            !empty($_POST["NomF"]) && 
			      !empty($_POST["Duree"]) && 
            !empty($_FILES["video"]) && 
            !empty($_POST["descriptionn"]) &&
            !empty($_POST["NomS"])&&
            !empty($_POST["NbPlaces"]) 
        ) {
            $films = new Film(
                $_POST['NomF'], 
				        $_POST['Duree'],
                $_FILES['video'],
                $_POST['descriptionn'],
                $_POST['NomS'],
                $_POST['NbPlaces']
            );
            $FilmC->ModifierFilm($films,$_GET["idFilm"]);
            header('Location:AfficherFilm.php?mess= Film Modifé avec succés');

        }
        else
         //            Partie Controle Saisie //+
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
    <style>
  .error-message {
    color: red;
    font-size: 0.8em;
    margin-top: 0.2em;
  }
     </style>
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
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
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
                
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Modifier Film</h3></div>
                                    <div class="card-body">
                                        

                                    <div id="error">
            <?php echo $error; ?>
        </div>
			
		<?php
			if (isset($_GET['idFilm'])){
				$films = $FilmC->RecupererFilm($_GET['idFilm']);
            
		?>
    
    <form method="post" class="form"  enctype="multipart/form-data" id="form" onsubmit="return validateForm();" >
            <!--------------------------------------------Nom Film------------------------------------------------->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label "  >Nom Film</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="NomF" id="NomF" value="<?php echo $films['NomF'];?>">
                    <div id="nomf-error" class="error-message"></div>
                </div>
            </div>
            <!---------------------------------------------Durée---------------------------------------------->
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label "  >Durée</label>
                <div class="col-sm-6">
                    <input type="time" class="form-control" name="Duree" id="Duree" value="<?php echo $films['Duree']; ?>">
                    <div id="Duree-error" class="error-message"></div>
                </div>
            </div>

            <!---------------------------------------------img---------------------------------------------->
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label " >Image</label>
                      <div class="col-sm-6">
                    <input type="file" class="form-control" name="video"  id="video" value="<?php echo $films['video']; ?>">
                      </div>
                </div>
            <!---------------------------------------------descriptionn---------------------------------------------->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label "  >Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="descriptionn" id="descriptionn" value="<?php echo $films['descriptionn']; ?>">
                </div>
             </div>
             <!---------------------------------------------Nom Salle---------------------------------------------->                

             <div class="input-group mb-3">
    <label class="col-sm-3 col-form-label">Nom Salle</label>
    <div class="col-sm-6">
        <select id="salleId" name="NomS" class="form-control">
            <?php
            // récupérer la liste des salles
            function ModifierSalle($salles, $idS)
            {
                try {
                    $db = config::getConnexion();
                    $query = $db->prepare('UPDATE salles SET NomS = :NomS WHERE idS = :idS');
                    $query->execute([
                        'NomS' => $salles->getNomS(),
                        'idS' => $idS
                    ]);
                    echo $query->rowCount() . " records UPDATED successfully <br>";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }

            $listeSalles = $FilmC->AfficherSalle();
            foreach ($listeSalles as $salle) {
                $idS = $salle['idS'];
            ?>
                <option value="<?php echo $salle['idS']; ?>" <?php if ($idS && $salle['idS'] == $idS) echo "selected"; ?>><?php echo $salle['NomS']; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>

 
            <!---------------------------------------------Nombre des places---------------------------------------------->                

                    <div class="input-group mb-3">
           <label class="col-sm-3 col-form-label">Nombre Places</label>
                <div class="col-sm-6">
                  <select id="idS" name="NbPlaces" class="form-control">
            <?php 
            //récupérer la liste des salles 
            $listeSalles = $FilmC->AfficherSalle();
            foreach($listeSalles as $salle) {
                ?>
                <option value="<?php echo $salle['idS']; ?>" <?php if ($salle['idS'] == $idS) echo "selected"; ?>><?php echo $salle['NbPlaces']; ?></option>
                <?php
            }
            ?>
          </select>
      </div>
  </div>

    <?php
        if (isset($_POST['Modifier'])) {
        $idS = $_POST['idS'];
        $NbPlaces = $_POST['NbPlaces'];
        $FilmC->ModifierSalle($salles, $_POST['idS']);
        }     
        ?>
             <!---------------------------------------------Buttons---------------------------------------------->
             <div class="row mb-5">
             <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Modifier</button>
             </div>
             <div class="col-sm-3 d-grid">
                 <a class="btn btn-primary" href="AfficherFilm.php" role="button">Retour</a>
             </div>
          </div>
            </table>
        </form>
        <?php } ?>


                                    </div>
                                    
                                </div>
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
