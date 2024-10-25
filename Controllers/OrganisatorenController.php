<?php

namespace App\Controllers;
use App\Models\Organisator;

class OrganisatorController extends BaseController {

    public static function list () {
        $organisatoren = Organisator::list();

        print_r($organisatoren);

        self::loadView('/organisatoren/list', [
            'organisatoren' => $organisatoren
        ]);
    }

     public static function detail ($id) {
        $organisator = organisatoren::find($id);

        self::loadView('/organisatoren/detail', [
            'Organisatoren' => $organisator
        ]);
    }

     public static function create ($organisator_details) {
        $organisator = organisatoren::create($organisator_details);

        self::loadView('/organisatoren/detail', [
            'Organisatoren' => $organisatoren
        ]);
    }

    public static function update ($organisator_details) {
        $organisator = organisatoren::update($organisator_details);

        self::loadView('/organisatoren/detail', [
            'Organisatoren' => $organisatoren
        ]);
    }

     public static function remove ($id) {
        $organisatoren = organisatoren::remove($id);

        self::loadView('/organisatoren/list', [
            'Organisatoren' => $organisatoren
        ]);
    }
}