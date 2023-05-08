
<?php

include '../Controller/reservationR.php';
include_once   'phpmailer/src/Exception.php';
include_once   'phpmailer/src/PHPMailer.php';
include_once   'phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = "";

// create client
$reservation = null;

// create an instance of the controller
$reservationR = new reservationR();
if 
   ( isset($_POST['idclient']) &&
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['nomfilm']) &&
    isset($_POST['datefilm'])
) {
    if (!empty($_POST['idclient']) &&
        !empty($_POST['nom']) &&
        !empty($_POST['prenom']) &&
        !empty($_POST['email']) &&
        !empty($_POST['nomfilm']) &&
        !empty($_POST['datefilm'])
    ) {
        $reservation = new reservation(
            $_POST['idclient'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['nomfilm'],
            new DateTime($_POST['datefilm'])
        );
        $reservationR->addreservation($reservation);
        $mail=new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host ='smtp.gmail.com';
                $mail->SMTPAuth=true;
                $mail->Username='chaima.naouali@esprit.tn';
                $mail->Password='dugzvbgqtdskwggl';
                $mail->SMTPSecure='ssl';
                $mail->Port=465;
                $mail->setFrom('chaima.naouali@esprit.tn');
                $mail->addAddress($_POST["email"]);
                $mail->isHTML(true);
                $mail->Subject="THANK YOU !!";
                $mail->Body="reservation successfully ! ";
                $mail->send();
        header('Location:liste_reservation.php');
    } else
        $error = "Missing information";
}

?>









<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <a href="liste_reservation.php">Back to list </a>
    <hr>

    <div idclient="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table border="1" align="center">
        <tr>
        <tr>
                <td>
                    <label for="idclient">idclient:
                    </label>
                </td>
                <td><input type="int" name="idclient" id="idclient" ></td>
            </tr>
                
            <tr>
                <td>
                    <label for="nom">First Name:
                    </label>
                </td>
                <td><input type="text" name="nom" id="nom" maxlength="20"></td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Last Name:
                    </label>
                </td>
                <td><input type="text" name="prenom" id="prenom" maxlength="20"></td>
            </tr>
            <tr>
                <td>
                    <label for="email">email:
                    </label>
                </td>
                <td><input type="text" name="email" id="email" maxlength="200"></td>
            </tr>
            <tr>
                <td>
                    <label for="nomfilm">nomfilm:
                    </label>
                </td>
                <td>
                    <input type="text" name="nomfilm" id="nomfilm" maxlength="20" >
                </td>
            </tr>
           
            <tr>
            <td>
                    <label for="datefilm">datefilm:
                    </label>
                </td>
                <td><input type="date" name="datefilm" id="datefilm" ></td>
            </tr>
            
               
           
                
            <tr>
            <tr align="center">
                <td>
                    <input type="submit" value="send">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>