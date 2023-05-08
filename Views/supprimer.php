



<?php
include '../Controller/reservationR.php';
$reservationR = new reservationR();
$reservationR->deleteReservation($_GET["idclient"]);
header('Location:Liste_reservation.php');
?>