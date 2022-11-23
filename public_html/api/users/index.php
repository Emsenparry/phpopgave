<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php');

/**
 * Liste af userss
 */
Route::add('/api/users/', function() {
	$users = new Users; 
	$result = $users->list();
	echo Tools::jsonParser($result);
});

/**
 * users detaljer
 */
Route::add('/api/users/([0-9]*)', function($id) {
	$users = new Users; 
	$result = $users->details($id);
	echo Tools::jsonParser($result);
});

/**
 * POST - Opret users
 */
Route::add('/api/users/', function() {
	// var_dump($_POST);
	$users = new Users;
    // $users->id = isset($_POST['id']) && !empty($_POST['id']) ? (int)$_POST['id'] : null;
	$users->username = isset($_POST['username']) && !empty($_POST['username']) ? $_POST['username'] : null;
    $users->password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null;
    $users->email = isset($_POST['email']) && !empty($_POST['email']) ? $_POST['email'] : null;
    $users->firstname = isset($_POST['firstname']) && !empty($_POST['firstname']) ? $_POST['firstname'] : null;
    $users->lastname = isset($_POST['lastname']) && !empty($_POST['lastname']) ? $_POST['lastname'] : null;
    $users->address = isset($_POST['address']) && !empty($_POST['address']) ? $_POST['address'] : null;
    $users->zipcode = isset($_POST['zipcode']) && !empty($_POST['zipcode']) ? (int)$_POST['zipcode'] : null;

    if($users->username && $users->password && $users->email && $users->firstname && $users->lastname && $users->address && $users->zipcode) {
		// var_dump($users);
		echo $users->create();
	} else {
		echo "Kan ikke oprette users.";
	}
	
}, 'post');

/**
 * PUT - Opdater users
 */
Route::add('/api/users/', function() {
	$data = file_get_contents("php://input");
	parse_str($data, $parsed_data);
	
	$users = new Users;
	$users->id = isset($parsed_data['id']) && !empty($parsed_data['id']) ? (int)$parsed_data['id'] : null;
	$users->username = isset($parsed_data['username']) && !empty($parsed_data['username']) ? $parsed_data['username'] : null;
    $users->password = isset($parsed_data['password']) && !empty($parsed_data['password']) ? $parsed_data['password'] : null;
    $users->email = isset($parsed_data['email']) && !empty($parsed_data['email']) ? $parsed_data['email'] : null;
    $users->firstname = isset($parsed_data['firstname']) && !empty($parsed_data['firstname']) ? $parsed_data['firstname'] : null;
    $users->lastname = isset($parsed_data['lastname']) && !empty($parsed_data['lastname']) ? $parsed_data['lastname'] : null;
    $users->address = isset($parsed_data['address']) && !empty($parsed_data['address']) ? $parsed_data['address'] : null;
    $users->zipcode = isset($parsed_data['zipcode']) && !empty($parsed_data['zipcode']) ? (int)$parsed_data['zipcode'] : null;

	if($users->id) {
		echo $users->update();
	} else {
		echo "Kan ikke opdatere users.";
	}
	
}, 'put');


/**
 * DELETE - Slet en users
 */
Route::add('/api/users/([0-9]*)', function($id) {
	$users = new Users;
	if($users->id && $users->username && $users->password && $users->email && $users->firstname && $users->lastname && $users->address && $users->zipcode) {
		echo $users->delete($id);	
	} else {
		echo "Kan ikke oprette users.";
	}
	
}, 'delete');

Route::run('/');
?>