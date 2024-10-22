<?php

//$router->get('/', function() { echo 'Dit is de list vanuit de route'; });
$router->setNamespace('\App\Controllers');
$router->get('/', 'HomeController@index');


$router->get('/test', function(){ echo'router werkt'; } ); // test route
// routes voor de eveenenementen
$router->get('/evenementen', 'EvenementenController@list');      
$router->get('/evenementen/{id}', 'EvenementenController@detail');
$router->post('/evenementen', 'EvenementenController@create');
$router->put('/evenementen/{id}', 'EvenementenController@update');
$router->delete('/evenementen/{id}', 'EvenementenController@remove');

// //routes voor de deelnemers
$router->get('/deelnemers', 'DeelnemerController@list');
$router->get('/deelnemers/{id}', 'DeelnemerController@detail');
$router->post('/deelnemers', 'DeelnemerController@create');
$router->put('/deelnemers/{id}', 'DeelnemerController@update');
$router->delete('/deelnemers/{id}', 'DeelnemerController@remove');

// // routes voor de organisators
$router-get('/organisators', 'OrganisatorController@list');
$router->get('/organisators/{id}', 'OrganisatorController@detail');
$router->post('/organisators', 'OrganisatorController@create');
$router->put('/organisators/{id}', 'OrganisatorController@update');
$router->delete('/organisators/{id}', 'OrganisatorController@remove');

//routes voor niet gevonden pagina's
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404, pagina niet gevonden';
});