<?php

namespace App\Controllers;
use App\Models\Organisator;

class OrganisatorController extends BaseController {

    public static function list () {
        $organisatoren = Organisator::list();
        self::loadView('/organisatoren/list', [
            'organisatoren' => $organisatoren
        ]);
    }

     public static function details ($id) {
        $organisator = Organisator::find($id);
        $evenementen = Organisator::findEvents($id);
        $organisatoren = organisator::list();
        self::loadView('/organisatoren/details', [
            'organisator' => $organisator,
            'evenementen' => $evenementen,
            'organisatoren' => $organisatoren
        ]);
    }

     public static function create ($organisator_details) {
        $organisator = organisatoren::create($organisator_details);

        self::loadView('/organisatoren/details', [
            'Organisatoren' => $organisatoren
        ]);
    }

    public static function updateOrDelete ($organisator_details) {
        // $organisator = organisatoren::update($organisator_details);

        // self::loadView('/organisatoren/list', [
        //     'Organisatoren' => $organisatoren
        // ]);
        if (isset($_POST['delete'])) {
            $deelnemers = Organisator::verwijder($_POST['organisator_id']);
            // self::loadView('/deelnemers/list', [
            //     'deelnemers' => $deelnemers
            // ]);
        
        }
        elseif (isset($_POST['update'])) {
            $organisator = New Organisator();
            $organisator->organisator_id = $_POST['organisator_id'];
            $organisator->organisator_naam = $_POST['organisator_naam'];
            $organisator->organisator_functie = $_POST['organisator_functie'];

            $organisator->aanbevolen_organisator_id = ($_POST['hoofdorganisator_naam']=='')?NULL:$_POST['hoofdorganisator_naam'];

            $organisator = Organisator::change($organisator);
            
            // self::loadView('/organisatoren/list', [
            //     'organisatoren' => $organisatoren
            // ]);
        }
        header('Location: /organisatoren');



    }

    //  public static function remove ($id) {
    //     $organisatoren = organisatoren::remove($id);

    //     self::loadView('/organisatoren/list', [
    //         'Organisatoren' => $organisatoren
    //     ]);
    // }
}