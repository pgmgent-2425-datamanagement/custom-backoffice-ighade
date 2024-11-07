<?php
namespace App\Models;

class Deelnemer extends BaseModel {
    // public static function list() {
    //     //eigen code...
    // }
    public static function findTickets(int $id){
        $sql="  SELECT 
    e.evenement_id,
    e.naam AS evenement_naam,
    e.omschrijving AS evenement_omschrijving,
    DATE_FORMAT(e.datum, '%d/%m/%Y %H:%i') AS evenement_datum,
    e.prijs AS evenement_prijs,
    
    -- Locatieinformatie
    CONCAT(loc.straat, ' ', loc.nr, ', ', loc.postcode, ' ', loc.plaats, ' - ', loc.naam) AS locatie_volledig,
    
    -- Organisatorinformatie
    org.naam AS organisator_naam,
    org.functie AS organisator_functie,
    
    -- Categorieinformatie
    cat.naam AS categorie_naam
    
FROM 
    deelnemers AS d

-- Join met de tabel tickets om evenementen te vinden waar de deelnemer aan deelneemt
INNER JOIN 
    tickets AS t ON d.deelnemer_id = t.deelnemer_id
    
-- Join met de tabel evenementen om evenementinformatie op te halen
INNER JOIN 
    evenementen AS e ON t.evenement_id = e.evenement_id

-- Join met de tabel locaties om locatie-informatie op te halen
LEFT JOIN 
    locaties AS loc ON e.locatie_id = loc.locatie_id
    
-- Join met de tabel organisatoren om de organisatorinformatie op te halen
LEFT JOIN 
    organisatoren AS org ON e.organisator_id = org.organisator_id

-- Join met de tabel categorieën om categorie-informatie op te halen
LEFT JOIN 
    categorieën AS cat ON e.categorie_id = cat.categorie_id

-- Filter op een specifieke deelnemer ID
WHERE 
    d.deelnemer_id = :p_id;  -- Vervang het vraagteken met de specifieke deelnemer_id die je zoekt

                ";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ ':p_id' => $id ]);
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