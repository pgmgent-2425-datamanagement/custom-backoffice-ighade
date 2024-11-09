<?php

namespace App\Controllers;
use App\Models\Dashboard;


class HomeController extends BaseController {

    public static function index () {
        $topEvenementen = Dashboard::topEvenementen();
        $topDeelnemers = Dashboard::topDeelnemers();
        $topVerdiensten = Dashboard::topVerdiensten();
        self::loadView('/home', [
            'title' => 'Homepage',
            'topEvenementen' => $topEvenementen,
            'topDeelnemers' => $topDeelnemers,
            'topVerdiensten' => $topVerdiensten
        ]);
    }

}