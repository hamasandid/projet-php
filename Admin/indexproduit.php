<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'C:/xampp/htdocs/Cyjam/vendor/autoload.php';
use Stichoza\GoogleTranslate\GoogleTranslate;
require 'dbproduit.php';

if (isset($_GET['q'])) {
  $search_query = $_GET['q'];
  $sql = "SELECT * FROM produit WHERE nom_produit LIKE :search_query";
  $statement = $connection->prepare($sql);
  $statement->bindValue(':search_query', "%$search_query%");
} else {
$sql = 'SELECT * FROM produit';
$statement = $connection->prepare($sql);
}
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);


$translator = new Stichoza\GoogleTranslate\GoogleTranslate();
$translator->setSource('fr')->setTarget('en');
foreach ($people as $person) {
    $person->image_produit_en = $translator->translate($person->image_produit);}
  

    $sql = "SELECT COUNT(*) AS total_count FROM produit";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$total_count = $result['total_count'];

$sql = "SELECT COUNT(*) AS lecture_count FROM produit WHERE cateforie = 'lecture'";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$lecture_count = $result['lecture_count'];
$lecture_percentage = round(($lecture_count / $total_count) * 100, 2);

$sql = "SELECT COUNT(*) AS peinture_count FROM produit WHERE cateforie = 'peinture'";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$peinture_count = $result['peinture_count'];
$peinture_percentage = round(($peinture_count / $total_count) * 100, 2);

$sql = "SELECT COUNT(*) AS cinema_count FROM produit WHERE cateforie = 'cinema'";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);
$cinema_count = $result['cinema_count'];
$cinema_percentage = round(($cinema_count / $total_count) * 100, 2);
    




    
?>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="styles.css" rel="stylesheet" />
        
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
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
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
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table Product
                            </div>
                            <div class="card-body">

                                
        <form action="" method="get">
        <div class="form-group">
          <label for="search_query"></label>
          <input type="text" class="form-control" id="search_query" placeholder="search for a product" name="q" value="<?= $_GET['q'] ?? '' ?>">
        </div>
        <br>
        <center><button type="submit" class="btn btn-primary">Search</button></center>
      </form>
      <br><br>
      <table class="table table-bordered">
        <tr>
         
          <th>nom_produit</th>
          <th>prix_produit</th>
          <th>date_d'insertion</th>
          <th>image_produit </th>
          <th>image_produit_en</th>
          <th>categorie</th>
          <th>Action</th>
        </tr>
        <?php foreach($people  as $person): ?>
          <tr>
           
            <td><?= $person->nom_produit; ?></td>
            <td><?= $person->prix_produit; ?></td>
            <td><?= $person->date_dinsertion; ?></td>
            <td><?= $person->image_produit; ?></td>
            <td><?= $person->image_produit_en; ?></td>
            <td><?= $person->cateforie; ?></td>
            
            <td>
              <a href="editproduit.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deleteproduit.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          
        <?php endforeach; ?>
      </table>
      <center><button type="button" class="btn btn-primary" style="background-color; black;" onclick="exportPDF()">Export PDF</button></center><br>
     <center> <button type="button" class="btn btn-primary" style="background-color; black;"><a class="nav-link" href="createproduit.php" style="color: white;">Ajouter Produit</a></boutton></center>
    </div>
   <center> <h2>Pie chart of categories<h2> </center>
    <canvas id="pie-chart" style="margin-left: 350px;margin-right :300px" ></canvas>
    
      </div>
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

    <script>
  var ctx = document.getElementById('pie-chart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Lecture', 'Peinture', 'Cinema'],
      datasets: [{
        label: 'Category',
        data: [<?= $lecture_percentage ?>, <?= $peinture_percentage ?>, <?= $cinema_percentage ?>],
        backgroundColor: [
          'green',
          'red',
          'purple'
        ]
      }]
    },
    options: {
  title: {
    display: true,
    text: 'Category Distribution'
  },
  legend: {
    display: true,
    position: 'bottom'
  },
  fontSize: 16
}
  });  
   </script>
        

 
  
      </body>                   
</html>
