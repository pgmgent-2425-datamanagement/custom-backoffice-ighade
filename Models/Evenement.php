<?php
namespace App\Models;

class Evenement extends BaseModel {


    public static function list() {
       $query = "SELECT 
                    e.evenement_id,
                    e.naam AS evenement_naam,
                    e.omschrijving,
                    DATE_FORMAT(e.datum, '%d/%m/%Y %H:%i') AS datum,
                    CONCAT(l.naam,':  ',l.straat, ' ', l.nr, ', ', l.plaats, ' ', l.postcode) AS locatie,
                    e.prijs,
                    c.naam AS categorie,
                    o.naam AS organisator_naam,
                    o.functie AS organisator_functie
                FROM 
                    evenementen e
                JOIN 
                    locaties l ON e.locatie_id = l.locatie_id
                JOIN 
                    categorieën c ON e.categorie_id = c.categorie_id
                LEFT JOIN 
                    organisatoren o ON e.organisator_id = o.organisator_id;
                    
                ";
        
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute();
        $db_items = $pdo_statement->fetchAll(); 
                
        return parent::castToModel($db_items);

        // return $db_items;
    }
    public static function find(int $id){
        $query = "  SELECT 
                        e.evenement_id,
                        e.naam AS evenement_naam,
                        e.omschrijving AS evenement_omschrijving,
                        
                        -- Formatteer de datum en tijd in dd/mm/yyyy hh:mm
                        DATE_FORMAT(e.datum, '%d/%m/%Y %H:%i') AS evenement_datum,
                        
                        e.prijs AS evenement_prijs,
                        
                        -- Organisatorinformatie
                        org.organisator_id,
                        org.naam AS organisator_naam,
                        org.functie AS organisator_functie,
                        
                        -- Geconcateneerde locatie-informatie
                        CONCAT(loc.straat, ' ', loc.nr, ', ', loc.postcode, ' ', loc.plaats, ' - ', loc.naam) AS locatie_volledig,
                        
                        -- Categorieinformatie
                        cat.categorie_id,
                        cat.naam AS categorie_naam
                        
                     
                    FROM 
                        evenementen AS e
                        
                    -- Join met de tabel organisatoren om de organisatorinformatie op te halen
                    LEFT JOIN 
                        organisatoren AS org ON e.organisator_id = org.organisator_id
                        
                    -- Join met de tabel locaties om locatie-informatie op te halen
                    LEFT JOIN 
                        locaties AS loc ON e.locatie_id = loc.locatie_id
                        
                    -- Join met de tabel categorieën om categorie-informatie op te halen
                    LEFT JOIN 
                        categorieën AS cat ON e.categorie_id = cat.categorie_id
                
                    -- Filteren op een specifiek evenement ID
                    WHERE e.evenement_id = :evenement_id;   -- Vervang het vraagteken met het specifieke evenement_id dat je zoekt

                ";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute([ ':evenement_id' => $id ]);
        $db_items = $pdo_statement->fetchObject();
        return parent::castToModel($db_items);
    }

    public static function deelnemersOpEvenement(int $id){
        $query = "  SELECT deelnemers.deelnemer_id, deelnemers.naam, deelnemers.voornaam, deelnemers.email
                    FROM deelnemers
                    JOIN tickets ON deelnemers.deelnemer_id = tickets.deelnemer_id
                    JOIN evenementen ON tickets.evenement_id = evenementen.evenement_id
                    WHERE evenementen.evenement_id =  :evenement_id;";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute([ ':evenement_id' => $id ]);
        $db_items = $pdo_statement->fetchAll();
        return parent::castToModel($db_items);
    }

}