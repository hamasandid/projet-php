<?php
    include_once '../Model/Reclamation.php';
    include_once '../Controller/ReclamationC.php';

    $error = "";

    // create avis
    $reclamation = null;

    // create an instance of the controller
    $reclamationc = new ReclamationC();
    if (
        isset($_POST["nomclient"]) &&
        isset($_POST["cin"]) &&
        isset($_POST["email"]) &&
		isset($_POST["texte"])
    ) {
        if (
            !empty($_POST["nomclient"]) &&
            !empty($_POST["cin"]) &&
            !empty($_POST["email"]) &&
			!empty($_POST["texte"])
        ) {
            $reclamation = new Reclamation(
                $_POST['nomclient'],
                $_POST['cin'],
                $_POST['email'],
				$_POST['texte']
            );
            $reclamationc->ajouterreclamation($reclamation);
            header('Location:afficherListeReclamation.php');
        }
        else
            $error = "Missing information";
    }

    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>
    <body>
        <button><a href="afficherListeReclamation.php">Retour à la liste des reclamation</a></button>
        <hr>
        
        <div id="error">
            <?php echo $error; ?>
        </div>
        
        <form action="" method="POST" action="afficherListeReclamation.php">
        <input type="submit" name="Retour à la liste des reclamation" value="Retour à la liste des reclamation">
        <table border="1" align="center">

                
                <tr>
                    <td>
                        <label for="cin">N° Carte Identite :</label>
                    </td>
                    <td><input type="text" name="cin" id="cin" maxlength="20"></td>
                </tr>

                <tr>
                    <td>
                        <label for="nomclient">NOM DU CLIENT :</label>
                    </td>
                    <td><input type="text" name="nomclient" id="nomclient" maxlength="80"></td>
                </tr>

                <tr>
                    <td>
                        <label for="email">EMAIL DU CLIENT :</label>
                    </td>
                    <td><input type="text" name="email" id="email" maxlength="100"></td>
                </tr>

                <tr>
                    <td>
                        <label for="prenom">Votre Reclamation:
                        </label>
                    </td>
                    <td>
                        <textarea rows="2" name="texte" id="texte" cols="20"></textarea>
                   </td>
                </tr>
                
                <tr>
                    <td>
                        <input type="submit" value="Envoyer"> 
                        <input type="reset" value="Annuler" >
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>