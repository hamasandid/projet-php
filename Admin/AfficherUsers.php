<?php
session_start();



if($_SESSION['login']=="")
{

    header("location: signup.php");
}



include  "../Model/client.php";
include  "../Controller/ClientC.php";

$clientc= new ClientC();
$liste=$clientc->afficherClients();

$pdo = new PDO('mysql:host=localhost;dbname=user', 'root', '');

// Set page limit and current page
$limit = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate offset for current page
$offset = ($page - 1) * $limit;

// Get number of rows in table
$stmt_count = $pdo->prepare("SELECT COUNT(*) AS num_rows FROM client");
$stmt_count->execute();
$num_rows = $stmt_count->fetch(PDO::FETCH_ASSOC)['num_rows'];

// Get rows for current page
$stmt = $pdo->prepare("SELECT * FROM client LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>









    
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
                        
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Users
                            </div>
                            <div class="card-body">

                                
        
        
      <br><br>
      <table class="table bordered">
                                    <thead> 
                                        <tr>
                                                <th scope="col">Last Name</th>
                                                <th scope="col" >First Name</th>
                                                <th scope="col" >Email</th>
                                                <th scope="col" >Telephone</th>
                                                <th scope="col" >Adress</th>
                                                <th scope="col" >Sexe</th>
                                                <th scope="col" >Date Of Birth</th>
                                                <th scope="col" >Photo</th>
                                                <th scope="col" >Role</th>
                                                <th scope="col" >Status</th>
                                                <th scope="col" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($liste as $row){
                                      ?>
                                        <tr>
                                            <td><?php echo $row['nom']; ?></td>
                                            <td><?php echo $row['prenom']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['tel']; ?></td>
                                            <td><?php echo $row['adresse']; ?></td>
                                            <td><?php echo $row['sexe']; ?></td>
                                            <td><?php echo $row['date_nais']; ?></td>
                                            <td><img src="../Views/<?php echo $row['image']; ?>" heigth="200" width=150></td>
                                            <td><?php echo $row['role']; ?></td>
                                            <td><?php echo $row['statut']; ?></td>
                                            <td>
                                                <?php if($row['statut'] == "Verified"){ ?>
                                                    <a class="btn btn-danger" href="BloquerClient.php?id=<?PHP echo $row['id']; ?>">Block</a>
                                                <?php } ?>
                                                <?php if($row['statut'] == "Bloquer"){ ?>
                                                    <a class="btn btn-success" href="DebloquerClient.php?id=<?PHP echo $row['id']; ?>">Unblock</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                                <?php
                                            }
                                        ?>           
                                    </tbody>
                                </table>
     
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Client', 'Etat'],
      ['Blocked', <?php echo $clientc->recupererClientByEtat("Bloquer")->rowCount(); ?>],
      ['Verified', <?php echo $clientc->recupererClientByEtat("Verified")->rowCount(); ?>],
      ['Not Verified', <?php echo $clientc->recupererClientByEtat("Non Vérifé")->rowCount(); ?>]
    ]);

    var options = {
      title: '',
      backgroundColor: '#191C24',
      pieSliceTextStyle: {
        color: 'white'
      },
      pieSliceText: 'none', // hide percentage values

      colors: ['#b22222', '#EB1616', '#c90016'],
      legend: {
      position: 'top',
      alignment: 'center',
      textStyle: {
        color: 'gray'
      },
      markerShape: 'square', // display color indicators as squares
      markerBorderColor: 'white', // set the border color to white
    },
    markerShape: 'square', // display color indicators as squares
      markerBorderColor: 'white' // set the border color to white
      
    };

    var chart = new google.visualization.PieChart(document.getElementById('pie-chart'));
    chart.draw(data, options);
  }
</script>
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

    
  
   </script>
        

 
  
      </body>                   
</html>