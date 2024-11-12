<?php

//$router->get('/', function() { echo 'Dit is de list vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');


$router->get('/test', function(){ echo'router werkt'; } ); // test route
// routes voor de eveenenementen
$router->get('/evenementen', 'EvenementController@list');      
$router->get('/evenementen/{id}', 'EvenementController@details');
$router->post('/evenementen', 'EvenementController@create');
$router->post('/evenementen/{id}', 'EvenementController@updateOrDelete');

//routes voor de deelnemers
$router->get('/deelnemers', 'DeelnemerController@list');
$router->get('/deelnemers/{id}', 'DeelnemerController@details');
$router->post('/deelnemers', 'DeelnemerController@create');
$router->post('/deelnemers/{id}', 'DeelnemerController@updateOrDelete');

// routes voor de organisators
$router->get('/organisatoren', 'OrganisatorController@list');
$router->get('/organisatoren/{id}', 'OrganisatorController@details');
$router->post('/organisatoren', 'OrganisatorController@create');
$router->post('/organisatoren/{id}', 'OrganisatorController@updateOrDelete');

// routes voor de filemanager
$router->get('/filemanager', 'FileManagerController@list');
$router->get('/filemanager/delete/{folder}/{id}', 'FileManagerController@delete');
$router->get('/filemanager/{folder}', 'FileManagerController@list');

// api routes
$router->get('/api/evenementen', 'EvenementController@apiList');
$router->get('/api/evenementen/{id}', 'EvenementController@apiDetails');
$router->post('/api/evenementen', 'EvenementController@apiCreate');

//routes voor niet gevonden pagina's
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404, pagina niet gevonden';
});