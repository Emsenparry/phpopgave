<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/assets/incl/init.php');


Route::add('/api/artist/', function() {
	echo 'Hej verden';
});


Route::run('/');
?>