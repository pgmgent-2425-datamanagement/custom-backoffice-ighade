<?php

namespace App\Controllers;
use App\Models\Evenementen;

class EvenementenController extends BaseController {

    public static function list () {
        $evenementen = evenementen::list();

        self::loadView('/evenementen/list', [
            'Evenementen' => $evenementen
        ]);
    }

     public static function detail ($id) {
        $evenement = evenementen::find($id);

        self::loadView('/evenementen/detail', [
            'Evenementen' => $evenement
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