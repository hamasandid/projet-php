
<?php
include '../Controller/reservationR.php';
$reservationR = new reservationR();
$list = $reservationR->listreservation();
/*function searchReservation($searchTerm) {
    $result = null;
    $sql = "SELECT * FROM reservation WHERE nomfilm LIKE '%.$searchTerm.%'";
    // Execute the SQL query and assign the result to $result
    return $result;
}

$search = '';
$result = null;

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $result = searchReservation($search);
}*/

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
	<body>
	    
		
		
<?php
    echo "<a href='generate_pdf.php'> <img src='assets/pdf.png' width=60 style='margin-left: 95%; margin-top: -5%;'></a>";


?>
    <center>
        <h1>List of reservations</h1>
        <h2>
            
        </h2>
    </center>
    <div class="table-responsive">
                      <table id="tableFilm" class="table">
        <tr>
            <th>Id Client</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>EMAIL</th>
            <th>NAME OF FILM</th>
            <th>Date of FILM</th>
           

            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($list as $reservation ) {
        ?>
            <tr>
                <td><?= $reservation['idclient']; ?></td>
                <td><?= $reservation['nom']; ?></td>
                <td><?= $reservation['prenom']; ?></td>
                <td><?= $reservation['email']; ?></td>
                <td><?= $reservation['nomfilm']; ?></td>
                <td><?= $reservation['datefilm']; ?></td>

                
 <!-- Navbar-->

 <!--<form method="post" action="#" style="margin:auto;max-width:300px">
    <input style='box-sizing: border-box;' type="text" placeholder="Rechercher.." name="search"  required>
    <button style="font-size: 17px;" type="submit">&#128269;</button>
  </form><br>-->
               
                <td align="center">
                    <form method="POST" action="modifier.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $reservation['idclient']; ?> name="idclient">
                    </form>
                </td>
                <td>
                    <a href="supprimer.php?idclient=<?php echo $reservation['idclient']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

<script>
  document.getElementById('pdfBtn').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'generate_pdf.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                window.open('generated_pdf.pdf');
            }
        };
        xhr.send('generate_pdf=true');
    });  </script>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
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
        