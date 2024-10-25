<?php

//$router->get('/', function() { echo 'Dit is de list vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');


$router->get('/test', function(){ echo'router werkt'; } ); // test route
// routes voor de eveenenementen
$router->get('/evenementen', 'EvenementController@list');      
$router->get('/evenementen/{id}', 'EvenementController@details');
$router->post('/evenementen', 'EvenementController@create');
$router->put('/evenementen/{id}', 'EvenementController@update');
$router->delete('/evenementen/{id}', 'EvenementController@remove');

// //routes voor de deelnemers
$router->get('/deelnemers', 'DeelnemerController@list');
$router->get('/deelnemers/{id}', 'DeelnemerController@details');
$router->post('/deelnemers', 'DeelnemerController@create');
$router->put('/deelnemers/{id}', 'DeelnemerController@update');
$router->delete('/deelnemers/{id}', 'DeelnemerController@remove');

// // routes voor de organisators
$router->get('/organisatoren', 'OrganisatorController@list');
$router->get('/organisatoren/{id}', 'OrganisatorController@details');
$router->post('/organisatoren', 'OrganisatorController@create');
$router->put('/organisatoren/{id}', 'OrganisatorController@update');
$router->delete('/organisatoren/{id}', 'OrganisatorController@remove');

//routes voor niet gevonden pagina's
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404, pagina niet gevonden';
});