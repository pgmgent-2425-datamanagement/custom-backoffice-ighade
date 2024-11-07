<?php

namespace App\Controllers;
use App\Models\Deelnemer;

class DeelnemerController extends BaseController {

    public static function list () {
        $deelnemers = Deelnemer::list();
    
        self::loadView('/deelnemers/list', [
            'deelnemers' => $deelnemers
        ]);
    }

     public static function details ($id) {
        $deelnemer = Deelnemer::find($id);
        $tickets = Deelnemer::findTickets($id);
        self::loadView('/deelnemers/details', [
            'deelnemer' => $deelnemer,
            'tickets' => $tickets
        ]);
    }

     /*public static function create ($deelnemer_details) {
        $deelnemers = Deelnemers::create($deelnemer_details);

        self::loadView('/deelnemers/details', [
            'deelnemers' => $deelnemers
        ]);
    }*/

    public static function updateOrDelete () {
        if (isset($_POST['delete'])) {
            $deelnemers = Deelnemer::verwijder($_POST['deelnemer_id']);
            self::loadView('/deelnemers/list', [
                'deelnemers' => $deelnemers
            ]);
        }
        elseif (isset($_POST['update'])) {
            $deelnemer = New Deelnemer();
            $deelnemer->deelnemer_id = $_POST['deelnemer_id'];
            $deelnemer->naam = $_POST['naam'];
            $deelnemer->voornaam = $_POST['voornaam'];
            $deelnemer->email = $_POST['email'];

            $deelnemers = Deelnemer::change($deelnemer);
            
            self::loadView('/deelnemers/list', [
                'deelnemers' => $deelnemers
            ]);
        }
        header('Location: /deelnemers');
    }

     /*public static function remove ($id) {
        $Deelnemers = Deelnemers::verwijder($id);

        self::loadView('/deelnemers/list', [
            'deelnemers' => $deelnemers
        ]);
    }*/
}