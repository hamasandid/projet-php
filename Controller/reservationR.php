<?php
include '../config.php';
include '../Model/reservation.php';

class reservationR
{
    public function listreservation()
    {
        $sql = "SELECT * FROM reservation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteReservation($idclient)
    {
        $sql = "DELETE FROM reservation WHERE idclient = :idclient";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idclient', $idclient);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addreservation($reservation)
    {
        $sql = "INSERT INTO reservation (idclient, nom, prenom,email, nomfilm, datefilm) VALUES (:idclient, :nom, :prenom,:email, :nomfilm, :datefilm)";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':idclient', $reservation->get_id());
            $req->bindValue(':nom', $reservation->get_nom());
            $req->bindValue(':prenom', $reservation->get_prenom());
            $req->bindValue(':email', $reservation->get_email());
            $req->bindValue(':nomfilm', $reservation->get_nomfilm());
            $req->bindValue(':datefilm', $reservation->get_date_f()->format('Y-m-d'));
            $req->execute();
            return $reservation;
        } catch (PDOException $e) {
            echo 'Error adding reservation: ' . $e->getMessage();
            var_dump($req->errorInfo());
            return null;
        }
    }
    
    

    function updateReservation($reservation, $idclient)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reservation SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    nomfilm = :nomfilm, 
                    datefilm = :datefilm
                WHERE idclient = :idclient'
            );
            $query->execute([
                'idclient' => $idclient,
                'nom' => $reservation->get_nom(),
                'prenom' => $reservation->get_prenom(),
                'email' => $reservation->get_email(),
                'nomfilm' => $reservation->get_nomfilm(),
                'datefilm' => $reservation->get_date_f()->format('Y-m-d'),
            ]);
        } catch (PDOException $e) {
            echo 'Error updating reservation: ' . $e->getMessage();
        }
    }
    

    function showReservation($idu)
    {
        $sql = "SELECT * from reservation where idclient = $idu";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $reservation = $query->fetch();
            return $reservation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
