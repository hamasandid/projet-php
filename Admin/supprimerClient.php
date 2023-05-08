<?PHP
include "../Controller/ClientC.php";


$clientC=new ClientC();
if (isset($_POST["id"])){

	$clientC->supprimerClient($_POST["id"]);
	header('Location: AfficherUsers.php');
}

?>