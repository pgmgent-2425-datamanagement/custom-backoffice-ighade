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

        // upload image
        $name = uniqid() . '-' .$_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $to_folder = BASE_DIR . '/public/images/deelnemers/'. $name;
        
        move_uploaded_file($tmp_name, $to_folder);
        $deelnemer->image = $name;

        $deelnemers = Deelnemer::create($deelnemer);
        header('Location: /deelnemers');
    }

    public static function updateOrDelete () {

        if (isset($_POST['delete'])) {
            $deelnemers = Deelnemer::verwijder($_POST['deelnemer_id']);
            self::loadView('/deelnemers/list', [
                'deelnemers' => $deelnemers
            ]);
        }
        elseif (isset($_POST['update'])) {
            $deelnemer = New Deelnemer();
            $deelnemer->deelnemer_id = $_POST['deelnemer_id'];
            $deelnemer->naam = $_POST['naam'];
            $deelnemer->voornaam = $_POST['voornaam'];
            $deelnemer->email = $_POST['email'];

            // vervang oude image met nieuwe image 
            if(isset($_POST['oldImage']) && !empty($_FILES['image']['name'])){
                $name = uniqid() . '-' .$_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $to_folder = BASE_DIR . '/public/images/deelnemers/'. $name;
                
                move_uploaded_file($tmp_name, $to_folder);  
                unlink(BASE_DIR . '/public/images/deelnemers/'. $_POST['oldImage']);

                $deelnemer->image = $name;
            }
            //hou oude image als geen nieuwe is gegeven 
            elseif(isset($_POST['oldImage']) && empty($_FILES['image']['name'])){
                $deelnemer->image = $_POST['oldImage'];
            }
            //voeg image toe als er geen oude image is gegeven
            elseif(!isset($_POST['oldImage']) && !empty($_FILES['image']['name'])){
                
                $name = uniqid() . '-' .$_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $to_folder = BASE_DIR . '/public/images/deelnemers/'. $name;
                
                move_uploaded_file($tmp_name, $to_folder);
                $deelnemer->image = $name;
            }else //geen oude image en geen nieuwe image
            {
                $deelnemer->image = null;
            }

           
            // put data in database
            $deelnemers = Deelnemer::change($deelnemer);

            self::loadView('/deelnemers/list', [
                'deelnemers' => $deelnemers
            ]);

        } else {
            if (isset($_POST['evenementen'])) {
                Deelnemer::updateEvenementen($_POST['deelnemer_id'], $_POST['evenementen']);
            }else{
                Deelnemer::updateEvenementen($_POST['deelnemer_id'], []);
            }
        }
        header('Location: /deelnemers');

    }
}