<?php
namespace App\Models;

class Deelnemer extends BaseModel {
    public static function list($search = '') {
        $sql = "SELECT * FROM deelnemers WHERE naam LIKE :search OR voornaam LIKE :search OR email LIKE :search";
        $searchTerm = '%' . $search . '%'; // Voeg wildcards toe aan de zoekterm
        global $db;
        $stmt = $db->prepare($sql);
        $stmt->execute([':search' => $searchTerm]);
        $results = $stmt->fetchAll();
        return parent::castToModel($results);
    }
    // public static function findTickets(int $id){
    //     $sql="  SELECT e.naam, e.datum, e.prijs
    //     FROM evenementen e
    //     JOIN tickets t ON e.evenement_id = t.evenement_id
    //     WHERE t.deelnemer_id = :deelnemer_id;
    //             ";
    //     global $db;
    //     $pdo_statement = $db->prepare($sql);
    //     $pdo_statement->execute([ ':deelnemer_id' => $id ]);
    //     $db_items = $pdo_statement->fetchAll();
    //     return parent::castToModel($db_items);
    // }

    
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
    public static function create(Deelnemer $deelnemer){
        $sql = "INSERT INTO deelnemers (naam, voornaam, email) VALUES (:naam, :voornaam, :email)";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([
            ':naam' => $deelnemer->naam,
            ':voornaam' => $deelnemer->voornaam,
            ':email' => $deelnemer->email
        ]);
    }
    public static function evenementen($deelnemer_id){
        $sql = "SELECT 
                    e.evenement_id, 
                    e.naam, 
                    e.prijs, 
                    e.datum,
                    CONCAT(loc.straat, ' ', loc.nummer, ', ', loc.postcode, ' ', loc.stad) AS locatie,
                    o.naam as organisator,

                    CASE 
                        WHEN t.deelnemer_id IS NOT NULL THEN TRUE 
                        ELSE FALSE 
                    END AS doet_mee
                FROM evenementen e
                JOIN organisatoren o ON e.organisator_id = o.organisator_id
                JOIN locaties loc on e.locatie_id = loc.locatie_id
                LEFT JOIN tickets t ON e.evenement_id = t.evenement_id AND t.deelnemer_id = :deelnemer_id
                ORDER BY doet_mee desc, e.datum asc;";
        global $db;
        $stmt = $db->prepare($sql);
        $stmt->execute([':deelnemer_id' => $deelnemer_id]);
        $results = $stmt->fetchAll();
        return parent::castToModel($results);
    }


    public static function updateEvenementen($deelnemer_id, $evenementen=[]) {
        global $db;
        // Stap 1: Verwijder alle bestaande evenementen voor de deelnemer
        $sql = "DELETE FROM tickets WHERE deelnemer_id = :deelnemer_id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':deelnemer_id' => $deelnemer_id]);
        // Stap 2: Voeg de nieuwe evenementen toe
        if (isset($evenementen)) {
        
            $sql = "INSERT INTO tickets (deelnemer_id, evenement_id) VALUES (:deelnemer_id, :evenement_id)";
            $stmt = $db->prepare($sql);

            foreach ($evenementen as $evenement_id) {
                $stmt->execute([
                    ':deelnemer_id' => $deelnemer_id,
                    ':evenement_id' => $evenement_id
                ]);
            } 
        }else {
            print_r('Geen evenementen geselecteerd');
        }

    }
}