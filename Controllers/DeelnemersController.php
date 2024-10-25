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
        print_r($deelnemer);
        self::loadView('/deelnemers/details', [
            'deelnemer' => $deelnemer
        ]);
    }

     public static function create ($deelnemer_details) {
        $deelnemers = Deelnemers::create($deelnemer_details);

        self::loadView('/deelnemers/detail', [
            'deelnemers' => $deelnemers
        ]);
    }

    public static function update ($deelnemer_details) {
        $deelnemers = Deelnemers::change($deelnemer_details);

        self::loadView('/deelnemers/detail', [
            'deelnemers' => $deelnemers
        ]);
    }

     public static function remove ($id) {
        $Deelnemers = Deelnemers::verwijder($id);

        self::loadView('/deelnemers/list', [
            'deelnemers' => $deelnemers
        ]);
    }
}