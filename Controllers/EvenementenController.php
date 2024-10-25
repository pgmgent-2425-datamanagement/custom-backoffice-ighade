<?php

namespace App\Controllers;
use App\Models\Evenement;

class EvenementController extends BaseController {

    public static function list () {
        $evenementen = Evenement::list();

        self::loadView('/evenementen/list', [
            'evenementen' => $evenementen
        ]);
    }

     public static function detail ($id) {
        $evenement = Evenement::find($id);

        self::loadView('/evenementen/detail', [
            'evenementen' => $evenement
        ]);
    }

     public static function create ($evenement_details) {
        $evenement = evenementen::create($evenement_details);

        self::loadView('/evenementen/detail', [
            'Evenementen' => $evenementen
        ]);
    }

    public static function update ($evenement_details) {
        $evenement = evenementen::update($evenement_details);

        self::loadView('/evenementen/detail', [
            'Evenementen' => $evenementen
        ]);
    }

     public static function remove ($id) {
        $evenementen = evenementen::remove($id);

        self::loadView('/evenementen/list', [
            'Evenementen' => $evenementen
        ]);
    }
}