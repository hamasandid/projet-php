<?PHP
include "../Controller/ClientC.php";
include "../Model/Client.php";



if (isset($_GET["email"]))
{

	$clientC = new ClientC();

	$liste=$clientC->recupereremail($_GET["email"]);
	
	//var_dump($res);
	 foreach($liste as $row)
	 {
		$id=$row['id'];
		$client=new Client($row['nom'],$row['prenom'],$row['email'],$row['mdp'],$row['tel'],$row['adresse'],$row['sexe'],$row['date_nais'],$row['role'],$row['statut']);
		$client->setStatut("Verified");
	 }

	 $clientC->modifierClient($client,$id);

	 echo "Message Sent OK</p>\n";
	 echo "<script type='text/javascript'>";
	 echo "alert('Validated Email!');
	 window.location.href='SignIn.php';";
	echo "</script>";
 }

?>
