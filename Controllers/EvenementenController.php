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

     public static function details ($id) {
        $evenement = Evenement::find($id);
        $deelnemers = Evenement::deelnemersOpEvenement($id);
        $organisatoren = Evenement::organisatoren();
        $categorien = Evenement::categorieën();
        self::loadView('/evenementen/details', [
            'evenement' => $evenement,
            'deelnemers' => $deelnemers,
            'organisatoren' => $organisatoren,
            'categorien' => $categorien
        ]);
    }

     public static function create ($evenement_details) {
        $evenement = evenementen::create($evenement_details);

        self::loadView('/evenementen/details', [
            'Evenementen' => $evenementen
        ]);
    }

    public static function updateOrDelete () {
        if (isset($_POST['delete'])) {
            Evenement::verwijder($_POST['evenement_id']);
        
        }
        elseif (isset($_POST['update'])) {
            $evenement = New Evenement();
            $evenement->evenement_id = $_POST['evenement_id'];
            $evenement->evenement_naam = $_POST['evenement_naam'];
            $evenement->evenement_omschrijving = $_POST['evenement_omschrijving'];
            $evenement->evenement_datum = $_POST['evenement_datum'];
            $evenement->evenement_prijs = $_POST['evenement_prijs'];

            $locatie = $_POST['locatie_volledig'];
            // Reguliere expressie om straat, nummer, postcode en stad te matchen
            $pattern = '/^(.*?)(\d+),\s*(\d{4})\s*(.+)$/';
            if (preg_match($pattern, $locatie, $matches)) {
                // De matches worden toegewezen aan variabelen voor straat, nummer, postcode en stad
                $straat = trim($matches[1]);   // De straatnaam (alles voor het nummer)
                $nummer = trim($matches[2]);   // Het nummer (1 of meer cijfers)
                $postcode = trim($matches[3]); // De postcode (exact 4 cijfers)
                $stad = trim($matches[4]);     // De stad (alles na de postcode)
                
                // Weergave van de resultaten
            } else {
                echo "Adres niet in het juiste formaat: " . $locatie;
            }
            $evenement->locatie_id = Evenement::ChangeLocatie($straat, $nummer, $postcode, $stad, $_POST['locatie_id']);
            // 
            
            // checkt als de categorie al bestaat
            if ($_POST['categorie_id'] != '') {
                $evenement->categorie_id = $_POST['categorie_id'];
            }
            // zoniet maakt hij een nieuwe categorie aan
            else {
                $evenement->categorie_id = Evenement::addCategorie($_POST['newCategorieNaam']);
            }


              // checkt als de ogranisator al bestaat
            if ($_POST['organisator_id'] != '') {
                $evenement->organisator_id = $_POST['organisator_id'];
            }
            // zoniet maakt hij een nieuwe organisator aan
            else {
                $evenement->organisator_id = Evenement::addOrganisator($_POST['newOrganisatorNaam'],$_POST['newOrganisatorFunctie']);
            }

            Evenement::change($evenement);
            
            // self::loadView('/organisatoren/list', [
            //     'organisatoren' => $organisatoren
            // ]);
        }
        header('Location: /evenementen');



    }


    // public static function update ($evenement_details) {
    //     $evenement = evenementen::update($evenement_details);

    //     self::loadView('/evenementen/details', [
    //         'Evenementen' => $evenementen
    //     ]);
    // }

    //  public static function remove ($id) {
    //     $evenementen = evenementen::remove($id);

    //     self::loadView('/evenementen/list', [
    //         'Evenementen' => $evenementen
    //     ]);
    // }
}