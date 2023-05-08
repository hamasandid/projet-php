
<?php
	include 'C:/xampp/htdocs/Cyjam/Controller/FilmsC.php';

 
	$FilmC=new FilmC();
  if (isset($_GET['search'])) {
    $listeFilms = $FilmC->Recherche($_GET['search']);
} elseif (isset($_GET['tr'])) {
    $listeFilms = $FilmC->TriFilms();
} elseif (isset($_GET['aa'])) {
    $listeFilms = $FilmC->TriDureeAs();
} elseif (isset($_GET['dd'])) {
    $listeFilms = $FilmC->TriDureeDec();
} else {
    $listeFilms = $FilmC->AfficherFilm(); 
}



$db = config::getConnexion();
$listeF = $FilmC->AfficherFilm(); 
// Check if there is a row in the video_views table for each film
foreach ($listeF as $film) {
    $filmId = $film['idFilm'];
    $sql = "SELECT COUNT(*) FROM video_views WHERE film_id = :film_id";
    $query = $db->prepare($sql);
    $query->bindParam(':film_id', $filmId);
    $query->execute();
    $count = $query->fetchColumn();

    // If there is no row, insert a new one with default value 0 for views
    if ($count == 0) {
        $sql = "INSERT INTO video_views (film_id, views) VALUES (:film_id, 0)";
        $query = $db->prepare($sql);
        $query->bindParam(':film_id', $filmId);
        $query->execute();
    }
}

//getting the views

$sql="SELECT films.*,video_views.views FROM films INNER JOIN video_views ON films.idFilm = video_views.film_id ORDER BY video_views.views DESC LIMIT 5 ";
$db = config::getConnexion();

$listerecom = $db->query($sql);
 

//end getting the views

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

                        <?php
                            if(isset($_GET['successMessage'])){
                                $successMessage = $_GET['successMessage'];
                                
                                echo "<div class='alert alert-warning alert-dismissible fade show' rol e='alert'>
                                '$successMessage'
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>"; 
                            }

                            if(isset($_GET['message'])){
                                $message = $_GET['message'];
                                
                                echo "<div class='alert alert-warning alert-dismissible fade show' rol e='alert'>
                                '$message'
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>"; 
                            }

                            if(isset($_GET['mess'])){
                                $mess = $_GET['mess'];
                                
                                echo "<div class='alert alert-warning alert-dismissible fade show' rol e='alert'>
                                '$mess'
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>"; 
                            }

                        ?>
                         <div>
                            <a  class="btn btn-primary" href="javascript:window.print()">Imprimer</a>
                
                        </div>
                            <table>
                                <thead>
                                    <td><a class="btn btn-primary" href="AjouterFilm.php" role="button">Nouveau Film</a></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                
                                    <td><a class="btn btn-primary" href="AfficherSalles.php" role="button">Liste des Salles</a></td>
                                </thead>
                            </table>
                        <div class="row">
                        <div class="col-md-8"> 
                            <div class="btn-group">
                                <button type="button"  class="btn btn-danger dropdown-toggle"  name="fltr" id="fltr"  data-bs-toggle="dropdown" aria-expanded="false">
                                Filtrer par
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="AfficherFilm.php?tr=y">Nom A->Z </a></li>
                                    <li><a class="dropdown-item" href="AfficherFilm.php?aa=y">Durée Courte</a></li>
                                    <li><a class="dropdown-item" href="AfficherFilm.php?dd=y">Durée Longue</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <form method="get"> 
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search...">
                            </form>
                        </div>
                        </div>


            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                        <th>id Film</th> 
                                        <th>Nom Film</th>	
                                        <th>Durée Film</th>
                                        <th>Vidéo</th>
                                        <th>Description</th>
                                        <th>Nom Salle</th>
                                        <th>Nb Places</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>id Film</th> 
                                        <th>Nom Film</th>	
                                        <th>Durée Film</th>
                                        <th>Vidéo</th>
                                        <th>Description</th>
                                        <th>Nom Salle</th>
                                        <th>Nb Places</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php
                    
                                        foreach($listeFilms as $films){
                                    ?>
                                    <tr>
                                        <td><?php echo $films['idFilm']; ?></td>
                                        <td><?php echo $films['NomF']; ?></td>
                                        <td><?php echo $films['Duree']; ?></td>
                                        <td><video width="40%" height="40%" poster="image/logo.jpg" controls>
                                        <source src="image/<?php echo $films['video']; ?>" type="video/mp4">
                                        <source src="image/<?php echo $films['video']; ?>" type="video/ogg">
                                        </video>
                                        </td>
                                        <td><?php echo $films['descriptionn']; ?></td>
                                        <td><?php 	
                                        $salle = $FilmC->RecupererSalle($films['idS']); /*Recuperation categorie par id dans une variable category*/
                                        $nomS=$salle['NomS'];
                                        echo $nomS;?></td>
                                        <td><?php 	
                                        $salle = $FilmC->RecupererSalle($films['idS']); /*Recuperation categorie par id dans une variable category*/
                                        $nbplaces=$salle['NbPlaces'];
                                        echo $nbplaces;?></td>


                                        <td>
                                        <form method="GET" action="ModifierFilm.php">
                                            <input type="submit"  class="btn btn-primary btn-sm" name="Modifier" value="Modifier">
                                            <input type="hidden"  value=<?php echo $films['idFilm']; ?>  name="idFilm">  
                                        </form>
                                        </td>
                                        <td>
                                        <a  class="btn btn-danger btn-sm"   href="SupprimerFilm.php?idFilm=<?php echo $films['idFilm']; ?>">Supprimer</a>
                                        </td>
                                        <td>
                                        <a href="AfficherFilmDesc.php?id=<?php echo $films['idFilm']; ?>">watch film</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>




                                <br>
                  <!-- affichage chart -->
                  <canvas id="myChart"></canvas>
                  <!-- affichage chart -->

                  <br>

                  <h1>recommanded for you</h1>
                  <div class="table-responsive">
                      <table id="tableFilm" class="table">
                      <thead>
                      <tr>
                        <th>id Film</th> 
                        <th>Nom Film</th>	
                        <th>Durée Film</th>
                        <th>Vidéo</th>
                        <th>Description</th>
                        <th>Nom Salle</th>
                        <th>Nb Places</th>
                        <th>Views</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                      </tr>
                      </thead>
                      <?php
                        
                        $labels=[];
                        $values=[];
                        foreach($listerecom as $films){
                          array_push($labels, $films['NomF']);
                          array_push($values, $films['views']);
                      ?>


                      <tr>
                        <td><?php echo $films['idFilm']; ?></td>
                        <td><?php echo $films['NomF']; ?></td>
                        <td><?php echo $films['Duree']; ?></td>
                        <td><video width="40%" height="40%" poster="image/logo.jpg" controls>
                        <source src="image/<?php echo $films['video']; ?>" type="video/mp4">
                        <source src="image/<?php echo $films['video']; ?>" type="video/ogg">
                        </video>
                        </td>
                        <td><?php echo $films['descriptionn']; ?></td>
                        <td><?php 	
                        $salle = $FilmC->RecupererSalle($films['idS']); /*Recuperation categorie par id dans une variable category*/
                        $nomS=$salle['NomS'];
                        echo $nomS;?></td>
                        <td><?php 	
                        $salle = $FilmC->RecupererSalle($films['idS']); /*Recuperation categorie par id dans une variable category*/
                        $nbplaces=$salle['NbPlaces'];
                        echo $nbplaces;?></td>
                        <td> <?php echo $films['views']; ?> views</td>


                        <td>
                          <form method="GET" action="ModifierFilm.php">
                            <input type="submit"  class="btn btn-primary btn-sm" name="Modifier" value="Modifier">
                            <input type="hidden"  value=<?php echo $films['idFilm']; ?>  name="idFilm">  
                          </form>
                        </td>
                        <td>
                          <a  class="btn btn-danger btn-sm"   href="SupprimerFilm.php?idFilm=<?php echo $films['idFilm']; ?>">Supprimer</a>
                        </td>
                        <td>
                          <a href="AfficherFilmDesc.php?id=<?php echo $films['idFilm']; ?>">watch film</a>
                        </td>
                      </tr>
                      <?php
                        }

                        // Encode the list as a JSON string
                        $label = json_encode($labels);
                        $value = json_encode($values);

                      ?>
                    </table>

                    <!-- chartjs -->
                    <script>
                    var labels = <?php echo $label; ?>;
                    var values = <?php echo $value; ?>;
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Views',
                          data: values,
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)'
                          ],
                          borderWidth: 1
                                        
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        },
                        plugins: {
                          title: {
                            display: true,
                            text: 'Top viewed movies Chart'
                          }
                        }
                      }
                    });
                  </script>
                      <!-- end chartjs -->



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
