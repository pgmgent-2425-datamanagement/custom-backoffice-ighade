<?php
namespace App\Models;

class fileModel extends BaseModel {
    public static function deleteFoto($fotoId){
        $sql="  UPDATE 
                    deelnemers
                SET 
                    image = NULL
                WHERE 
                    image = :fotoId;
                ";
        global $db;
        $pdo_statement = $db->prepare($sql);
        $pdo_statement->execute([ ':fotoId' => $fotoId ]);
    }
}