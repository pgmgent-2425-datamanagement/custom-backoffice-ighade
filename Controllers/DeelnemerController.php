 <?php

namespace App\Controllers;
use App\Models\Deelnemers;

class DeelnemersController extends BaseController {

    public static function list () {
        $deelnemers = Deelnemers::list();

        self::loadView('/deelnemers/list', [
            'deelnemers' => $deelnemers
        ]);
    }

     public static function details ($id) {
        $deelnemers = Deelnemers::find($id);

        self::loadView('/deelnemers/detail', [
            'deelnemers' => $deelnemers
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