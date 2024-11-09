<?php

namespace App\Controllers;
use App\Models\Organisator;

class OrganisatorController extends BaseController {

    public static function list () {
        $organisatoren = Organisator::list($search = $_GET['search']??"");
        $hoofdorganisatoren = Organisator::list();
        self::loadView('/organisatoren/list', [
            'organisatoren' => $organisatoren,
            'hoofdorganisatoren' => $hoofdorganisatoren
        ]);
    }

     public static function details ($id) {
        $organisator = Organisator::find($id);
        $evenementen = Organisator::findEvents($id);
        $organisatoren = organisator::list();
        self::loadView('/organisatoren/details', [
            'organisator' => $organisator,
            'evenementen' => $evenementen,
            'organisatoren' => $organisatoren,
            'categorieen' => $categorieen
        ]);
    }

     public static function create () {
        $organisator = New Organisator();
        $organisator->organisator_naam = $_POST['organisator_naam'];
        $organisator->organisator_functie = $_POST['organisator_functie'];
        $organisator->aanbevolen_organisator_id = ($_POST['hoofdorganisator_naam']=='')?NULL:$_POST['hoofdorganisator_naam'];
        organisator::create($organisator);

        header('Location: /organisatoren');
    }

    public static function updateOrDelete () {
        
        if (isset($_POST['delete'])) {
            $deelnemers = Organisator::verwijder($_POST['organisator_id']);
        }
        elseif (isset($_POST['update'])) {
            $organisator = New Organisator();
            $organisator->organisator_id = $_POST['organisator_id'];
            $organisator->organisator_naam = $_POST['organisator_naam'];
            $organisator->organisator_functie = $_POST['organisator_functie'];

            $organisator->aanbevolen_organisator_id = ($_POST['hoofdorganisator_naam']=='')?NULL:$_POST['hoofdorganisator_naam'];

            Organisator::change($organisator);
    
        }
        header('Location: /organisatoren');



    }
}