<?php

namespace App\Controllers;
use App\Models\Deelnemer;

class DeelnemerController extends BaseController {

    public static function list () {
        $deelnemers = Deelnemer::list($search = $_GET['search']??"");
    
        self::loadView('/deelnemers/list', [
            'deelnemers' => $deelnemers
        ]);
    }

     public static function details ($id) {
        $deelnemer = Deelnemer::find($id);
        // $tickets = Deelnemer::findTickets($id);
        $evenementen = Deelnemer::evenementen($id);
        self::loadView('/deelnemers/details', [
            'deelnemer' => $deelnemer,
            'evenementen' => $evenementen
        ]);
    }

    public static function create () {
        $deelnemer = New Deelnemer();
        $deelnemer->naam = $_POST['naam'];
        $deelnemer->voornaam = $_POST['voornaam'];
        $deelnemer->email = $_POST['email'];
        $deelnemers = Deelnemer::create($deelnemer);
        header('Location: /deelnemers');
    }

    public static function updateOrDelete () {

        if (isset($_POST['delete'])) {
            $deelnemers = Deelnemer::verwijder($_POST['deelnemer_id']);
            self::loadView('/deelnemers/list', [
                'deelnemers' => $deelnemers
            ]);
            header('Location: /deelnemers');
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
            header('Location: /deelnemers');

        } else {
            if (isset($_POST['evenementen'])) {
                Deelnemer::updateEvenementen($_POST['deelnemer_id'], $_POST['evenementen']);
                self::details($_POST['deelnemer_id']);                
            }else{
                Deelnemer::updateEvenementen($_POST['deelnemer_id'], []);
                self::details($_POST['deelnemer_id']);
            }
        }
    }

     /*public static function remove ($id) {
        $Deelnemers = Deelnemers::verwijder($id);

        self::loadView('/deelnemers/list', [
            'deelnemers' => $deelnemers
        ]);
    }*/
}