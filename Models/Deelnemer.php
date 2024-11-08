<?php
namespace App\Models;

class Deelnemer extends BaseModel {
    // public static function list() {
    //     //eigen code...
    // }
    public static function findTickets(int $id){
        $sql="  SELECT e.naam, e.datum, e.prijs
        FROM evenementen e
        JOIN tickets t ON e.evenement_id = t.evenement_id
        WHERE t.deelnemer_id = :deelnemer_id;
                ";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ ':deelnemer_id' => $id ]);
        $db_items = $pdo_statement->fetchAll();
        return parent::castToModel($db_items);
    }

    
public static function change(Deelnemer $deelnemer){
        $sql = "UPDATE deelnemers SET naam = :naam, voornaam = :voornaam, email = :email WHERE deelnemer_id = :deelnemer_id";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([
            ':deelnemer_id' => $deelnemer->deelnemer_id,
            ':naam' => $deelnemer->naam,
            ':voornaam' => $deelnemer->voornaam,
            ':email' => $deelnemer->email
        ]);
    }
    public static function verwijder(int $id){
        $sql = "DELETE FROM deelnemers WHERE deelnemer_id = :deelnemer_id";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([
            ':deelnemer_id' => $id
        ]);
    }

}