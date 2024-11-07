<?php
namespace App\Models;

class Evenement extends BaseModel {


    public static function list() {
       $query = "SELECT 
                    e.evenement_id,
                    e.naam AS evenement_naam,
                    e.omschrijving,
                    DATE_FORMAT(e.datum, '%d/%m/%Y %H:%i') AS datum,
                    CONCAT(l.straat, ' ', l.nummer, ', ', l.postcode, ' ', l.stad) AS locatie,
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
                        --DATE_FORMAT(e.datum, '%d/%m/%Y %H:%i') AS evenement_datum,
                        e.datum AS evenement_datum,
                        
                        e.prijs AS evenement_prijs,
                        
                        -- Organisatorinformatie
                        org.organisator_id,
                        org.naam AS organisator_naam,
                        org.functie AS organisator_functie,
                        
                        -- Geconcateneerde locatie-informatie
                        e.locatie_id,
                        CONCAT(loc.straat, ' ', loc.nummer, ', ', loc.postcode, ' ', loc.stad) AS locatie_volledig,
                        
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
    public static function organisatoren(){
        $query = "  SELECT 
                        organisator_id,
                        naam,
                        functie
                    FROM 
                        organisatoren;";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute();
        $db_items = $pdo_statement->fetchAll();
        return parent::castToModel($db_items);
    }
    public static function categorieën(){
        $query = "  SELECT 
                        categorie_id,
                        naam
                    FROM 
                        categorieën;";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute();
        $db_items = $pdo_statement->fetchAll();
        return parent::castToModel($db_items);
    }
    public static function addCategorie($categorie_naam){
        $query = "  INSERT INTO categorieën (naam) VALUES (:categorie_naam);";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute([ ':categorie_naam' => $categorie_naam ]);
        return $db->lastInsertId();
    }
    public static function addOrganisator($organisator_naam, $organisator_functie){
        $query = "  INSERT INTO organisatoren (naam, functie) VALUES (:organisator_naam, :organisator_functie);";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute([ ':organisator_naam' => $organisator_naam, ':organisator_functie' => $organisator_functie ]);
        return $db->lastInsertId();
    }
    public static function ChangeLocatie($straat, $nummer, $postcode, $stad, $locatie_id){
        $query = "
            UPDATE locaties 
            SET straat = :straat, nummer = :nummer, postcode = :postcode, stad = :stad
            WHERE locatie_id = :locatie_id;
        ";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute([ ':stad' => $stad, ':straat' => $straat, ':nummer' => $nummer, ':postcode' => $postcode, ':locatie_id' => $locatie_id ]);
        return $locatie_id;
    }
    public static function change($evenement){
        $query = "
            UPDATE evenementen 
            SET naam = :naam, omschrijving = :omschrijving, datum = :datum, prijs = :prijs, locatie_id = :locatie_id, categorie_id = :categorie_id, organisator_id = :organisator_id
            WHERE evenement_id = :evenement_id;
        ";
        global $db;
        $pdo_statement = $db->prepare($query);
        $pdo_statement->execute([
            ':evenement_id' => $evenement->evenement_id,
            ':naam' => $evenement->evenement_naam,
            ':omschrijving' => $evenement->evenement_omschrijving,
            ':datum' => $evenement->evenement_datum,
            ':prijs' => $evenement->evenement_prijs,
            ':locatie_id' => $evenement->locatie_id,
            ':categorie_id' => $evenement->categorie_id,
            ':organisator_id' => $evenement->organisator_id
        ]);
    }

}