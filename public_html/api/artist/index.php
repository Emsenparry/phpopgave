<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php');

/**
 * GET - Liste af artists
 */
Route::add('/api/artist/', function() {
	$artist = new Artist; 
	$result = $artist->list();
	echo Tools::jsonParser($result);
});

/**
 * GET - Artist detaljer
 */
Route::add('/api/artist/([0-9]*)', function($id) {
	$artist = new Artist; 
	$result = $artist->details($id);
	echo Tools::jsonParser($result);
});

/**
 * POST - Opret artist
 */
Route::add('/api/artist/', function() {
	// var_dump($_POST);
	$artist = new Artist;
	$artist->name = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : null;

	if($artist->name) {
		// var_dump($artist);
		echo $artist->create();
	} else {
		echo "Kan ikke oprette artist.";
	}
	
}, 'post');

/**
 * PUT - Opdater artist
 */
Route::add('/api/artist/', function() {
	$data = file_get_contents("php://input");
	parse_str($data, $parsed_data);
	
	$artist = new Artist;
	$artist->id = isset($parsed_data['id']) && !empty($parsed_data['id']) ? (int)$parsed_data['id'] : null;
	$artist->name = isset($parsed_data['name']) && !empty($parsed_data['name']) ? $parsed_data['name'] : null;

	if($artist->id && $artist->name) {
		echo $artist->update();
	} else {
		echo "Kan ikke opdatere artist.";
	}
	
}, 'put');


/**
 * DELETE - Slet en artist
 */
Route::add('/api/artist/([0-9]*)', function($id) {
	$artist = new Artist;
	if($artist->id) {
		echo $artist->delete($id);	
	} else {
		echo "Kan ikke slette artist.";
	}
	
}, 'delete');

Route::run('/');
?>