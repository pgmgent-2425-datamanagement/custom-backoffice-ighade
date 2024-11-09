<?php

namespace App\Controllers;
use App\Models\Evenement;

class EvenementController extends BaseController {

    public static function list () {
        $evenementen = Evenement::list($search = $_GET['search']??"");
        $categorieen = Evenement::categorieën();
        $organisatoren = Evenement::organisatoren();
        self::loadView('/evenementen/list', [
            'evenementen' => $evenementen,
            'categorieen'=> $categorieen,
            'organisatoren' => $organisatoren
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

     public static function create () {
        print_r($_POST);
        $evenement= New Evenement();
        if($_POST['categorie_id'] == ''){
            $evenement->categorie_id = Evenement::addCategorie($_POST['newCategorieNaam']);
        }
        else{
            $evenement->categorie_id = $_POST['categorie_id'];
        }
        if($_POST['organisator_id'] == ''){
            $evenement->organisator_id = Evenement::addOrganisator($_POST['newOrganisatorNaam'],$_POST['newOrganisatorFunctie']);
        }
        else{
            $evenement->organisator_id = $_POST['organisator_id'];
        }

        $evenement->evenement_naam = $_POST['evenement_naam'];
        $evenement->evenement_omschrijving = $_POST['evenement_omschrijving'];
        $evenement->evenement_datum = $_POST['evenement_datum'];
        $evenement->evenement_prijs = $_POST['evenement_prijs'];

        $locatieArray = self::splitLocatie($_POST['locatie_volledig']);
        $evenement->locatie_id = Evenement::createLocatie(...$locatieArray);

        Evenement::create($evenement);
        header('Location: /evenementen');

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

            $locatieArray = self::splitLocatie($_POST['locatie_volledig']);
            $evenement->locatie_id = Evenement::ChangeLocatie($_POST['locatie_id'], ...$locatieArray );
            
    
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
            

        }
        header('Location: /evenementen');



    }
    private static function splitLocatie($locatie) {
            // Reguliere expressie om straat, nummer, postcode en stad te matchen
            $pattern = '/^(.*?)(\d+),\s*(\d{4})\s*(.+)$/';
            if (preg_match($pattern, $locatie, $matches)) {
                // De matches worden toegewezen aan variabelen voor straat, nummer, postcode en stad
                $straat = trim($matches[1]);   // De straatnaam (alles voor het nummer)
                $nummer = trim($matches[2]);   // Het nummer (1 of meer cijfers)
                $postcode = trim($matches[3]); // De postcode (exact 4 cijfers)
                $stad = trim($matches[4]);     // De stad (alles na de postcode)
                
            } else {
                return [NULL, NULL, NULL, NULL];
            }
            return [$straat, $nummer, $postcode, $stad];
    }
}