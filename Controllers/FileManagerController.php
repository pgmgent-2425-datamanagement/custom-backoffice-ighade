<?php
namespace App\Controllers;
class FileManagerController extends BaseController {
    public static function list ($folder = ''){
        $files = scandir(BASE_DIR . '/public/images/'. $folder);
        self::loadView('/filemanager/list', [
            'files' => $files,
            'dir' => $folder
        ]);
    }
    public static function delete($folder, $file){
        unlink(BASE_DIR . '/public/images/' . $folder . '/' . $file);        
        header('Location: /filemanager/' . $folder);
    }
}