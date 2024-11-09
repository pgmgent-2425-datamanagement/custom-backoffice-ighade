<?php
namespace App\Models;

class Organisator extends BaseModel {
    // public static function list() {
    //  
    public static function list($search = '') {
        $sql="  SELECT 
                    org.organisator_id AS organisator_id,
                    org.naam AS organisator_naam,
                    org.functie AS organisator_functie,
                    hoofd.organisator_id AS hoofdorganisator_id,
                    hoofd.naam AS hoofdorganisator_naam,
                    hoofd.functie AS hoofdorganisator_functie
                FROM 
                    organisatoren AS org
                LEFT JOIN 
                    organisatoren AS hoofd 
                ON 
                    org.aanbevolen_organisator_id = hoofd.organisator_id
                WHERE 
                    org.naam LIKE :search OR org.functie LIKE :search OR hoofd.naam LIKE :search OR hoofd.functie LIKE :search
                ORDER BY 
                    hoofd.organisator_id;";
                
        global $db;
        $searchTerm = '%' . $search . '%'; // Voeg wildcards toe aan de zoekterm
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([':search' => $searchTerm]);
        $db_items = $pdo_statement->fetchAll();
        return parent::castToModel($db_items);
    }
    public static function find(int $id){
        $sql="  SELECT 
                    org.organisator_id AS organisator_id,
                    org.naam AS organisator_naam,
                    org.functie AS organisator_functie,
                    hoofd.organisator_id AS hoofdorganisator_id,
                    hoofd.naam AS hoofdorganisator_naam,
                    hoofd.functie AS hoofdorganisator_functie
                FROM 
                    organisatoren AS org
                LEFT JOIN 
                    organisatoren AS hoofd 
                ON 
                    org.aanbevolen_organisator_id = hoofd.organisator_id
                WHERE org.organisator_id = :p_id 
                ORDER BY 
                    org.organisator_id;
                ";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ ':p_id' => $id ]);
        $db_items = $pdo_statement->fetchObject();
        return parent::castToModel($db_items);
    }
    public static function findEvents(int $id){
        $sql="  SELECT 
                    ev.evenement_id AS evenement_id,
                    ev.naam AS evenement_naam,
                    ev.omschrijving AS evenement_omschrijving,
                    ev.datum AS evenement_datum,
                    ev.prijs AS evenement_prijs
                FROM 
                    evenementen AS ev
                WHERE 
                    ev.organisator_id = :p_id
                ORDER BY 
                    ev.evenement_id;
                ";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ ':p_id' => $id ]);
        $db_items = $pdo_statement->fetchAll();
        return parent::castToModel($db_items);
    }
    public static function change(Organisator $organisator){
        $sql = "UPDATE organisatoren SET naam = :naam, functie = :functie, aanbevolen_organisator_id = :aanbevolen_organisator_id WHERE organisator_id = :organisator_id";
        global $db;
  
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([
            ':organisator_id' => $organisator->organisator_id,
            ':naam' => $organisator->organisator_naam,
            ':functie' => $organisator->organisator_functie,
            ':aanbevolen_organisator_id' => $organisator->aanbevolen_organisator_id
        ]);
    }
    public static function verwijder(int $id){
        $sql = "DELETE FROM organisatoren WHERE organisator_id = :organisator_id";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([
            ':organisator_id' => $id
        ]);
    }
    public static function create(Organisator $organisator){
        $sql = "INSERT INTO organisatoren (naam, functie, aanbevolen_organisator_id) VALUES (:naam, :functie, :aanbevolen_organisator_id)";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([
            ':naam' => $organisator->organisator_naam,
            ':functie' => $organisator->organisator_functie,
            ':aanbevolen_organisator_id' => $organisator->aanbevolen_organisator_id
        ]);
    }
}