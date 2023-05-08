

<?php
include '../Controller/reservationR.php';
$error = "";

// create client
$reservation = null;

// create an instance of the controller
$reservationR = new reservationR();
if (
    isset($_POST['idclient']) &&
    isset($_POST['nom']) &&
    isset($_POST['prenom']) &&
    isset($_POST['email']) &&
    isset($_POST['nomfilm']) &&
    isset($_POST['datefilm'])
) {
    if (
        !empty($_POST['idclient']) &&
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
        $reservationR->updateReservation($reservation, $_POST['idclient']);
        header('Location: liste_reservation.php');
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>
<body>
    <button><a href="liste_reservation.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idclient'])) {
        $reservation = $reservationR->showReservation($_POST['idclient']);
    ?>

    <form action="" method="POST">
        <table border="1" align="center">
            <tr>
                <td>
                    <label for="idclient">idclient:</label>
                </td>
                <td>
                    <input type="int" name="idclient" id="idclient" value="<?php echo $reservation['idclient']; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nom">nom:</label>
                </td>
                <td>
                    <input type="text" name="nom" id="nom" value="<?php echo $reservation['nom']; ?>" maxlength="20">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">prenom:</label>
                </td>
                <td>
                    <input type="text" name="prenom" id="prenom" value="<?php echo $reservation['prenom']; ?>" maxlength="20">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">email:</label>
                </td>
                <td>
                    <input type="text" name="email" id="email" value="<?php echo $reservation['email']; ?>" maxlength="200">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nomfilm">nomfilm:</label>
                </td>
                <td>
                    <input type="text" name="nomfilm" value="<?php echo $reservation['nomfilm']; ?>" id="nomfilm">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="datefilm">datefilm :</label>
                </td>
                <td>
                    <input type="date" name="datefilm" id="datefilm" value="<?php echo date('Y-m-d', strtotime($reservation['datefilm'])); ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Update">
                </td>
            </tr>
        </table>
    </form>
    <?php
    }
    ?>
</body>
</html>
