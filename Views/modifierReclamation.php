<?php
    include_once '../Model/Reclamation.php';
    include_once '../Controller/ReclamationC.php';

    $error = "";

    // create adherent
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
            !empty($_POST['nomclient']) &&
            !empty($_POST['cin']) &&
            !empty($_POST['email']) &&
            !empty($_POST["texte"])
        ) {
            $reclamation = new Reclamation(
                $_POST['nomclient'],
                $_POST['cin'],
                $_POST['email'],
                $_POST['texte']
            );
            $reclamationc->modifierreclamation($reclamation, $_POST["id"]);
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
			
		<?php
			if (isset($_POST['id'])){
				$reclamation = $reclamationc->recupererreclamation($_POST['id']);
				
		?>
        
        <form action="" method="POST">
        <table border="1" align="center" class="table">
            <tr>
                    <td>
                        <label for="id">ID :
                        </label>
                    </td>
                    <td><input type="text" name="id" id="id" value="<?php echo $reclamation['id']; ?>" maxlength="20"></td>
                </tr>

                <tr>
                    <td>
                        <label for="nomclient">nom du client :
                        </label>
                    </td>
                    <td><input type="text" name="nomclient" id="nomclient" value="<?php echo $reclamation['nomclient']; ?>" maxlength="20" required="required"></td>
                </tr>

                <tr>
                    <td>
                        <label for="cin">N° Carte Identite :
                        </label>
                    </td>
                    <td><input type="text" name="cin" id="cin" value="<?php echo $reclamation['cin']; ?>" maxlength="20" required="required"></td>
                </tr>

                <tr>
                    <td>
                        <label for="email">email du client :
                        </label>
                    </td>
                    <td><input type="text" name="email" id="email" value="<?php echo $reclamation['email']; ?>" maxlength="100" required="required"></td>
                </tr>

                <tr>
                    <td>
                        <label for="texte">Votre reclamation:
                        </label>
                    </td>
                    <td>
                    <textarea rows="2" name="texte" id="texte" cols="20" value="<?php echo $reclamation['texte']; ?>"></textarea>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Envoyer">
                        <input type="reset" value="Annuler" > 
                    </td>
                </tr>
            </table>
        </form>
		<?php
		}
		?>
    </body>
</html>