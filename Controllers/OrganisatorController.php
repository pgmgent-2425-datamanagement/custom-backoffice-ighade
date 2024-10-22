<?php

namespace App\Controllers;
use App\Models\Organisatoren;

class OrganisatorenController extends BaseController {

    public static function list () {
        $organisatoren = organisatoren::list();

        self::loadView('/organisatoren/list', [
            'Organisatoren' => $organisatoren
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