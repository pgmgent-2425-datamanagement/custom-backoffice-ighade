<?php
namespace App\Models;

class Dashboard extends BaseModel {
    public static function topEvenementen(){
        global $db;
        $sql = "SELECT 
                    e.naam,
                    COUNT(t.evenement_id) AS aantal
                FROM 
                    evenementen e
                JOIN 
                    tickets t 
                ON 
                    e.evenement_id = t.evenement_id
                GROUP BY 
                    e.evenement_id
                ORDER BY 
                    aantal DESC
                LIMIT 5;";
        $stmt = $db->prepare($sql);
        $stmt->execute([]);
        $results = $stmt->fetchAll();
        return parent::castToModel($results);
    }
    public static function topDeelnemers(){
        global $db;
        $sql = "SELECT 
                    CONCAT(d.voornaam,' ', d.naam) AS naam,
                    COUNT(t.deelnemer_id) AS aantal
                FROM 
                    deelnemers d
                JOIN 
                    tickets t 
                ON 
                    d.deelnemer_id = t.deelnemer_id
                GROUP BY 
                    d.deelnemer_id
                ORDER BY 
                    aantal DESC
                LIMIT 5;";
        $stmt = $db->prepare($sql);
        $stmt->execute([]);
        $results = $stmt->fetchAll();
        return parent::castToModel($results);
    }
    public static function topVerdiensten(){
        global $db;
        $sql = "SELECT 
                    e.naam,
                    COUNT(t.evenement_id) * e.prijs AS aantal
                FROM 
                    evenementen e
                JOIN 
                    tickets t 
                ON 
                    e.evenement_id = t.evenement_id
                GROUP BY 
                    e.evenement_id
                ORDER BY 
                    aantal DESC
                LIMIT 5;";
        $stmt = $db->prepare($sql);
        $stmt->execute([]);
        $results = $stmt->fetchAll();
        return parent::castToModel($results);

    }
}