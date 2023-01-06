<?php
$dns = "mysql:host=localhost;dbname=songbook";
$username = 'root';
$password = '';

try {
    $db = new PDO($dns, $username, $password);
} catch (PDOException $err) {
    echo "Fejl i tilslutning af database" . $err;
}

$sql = "CREATE TABLE education (
            id BIGINT(20) NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL DEFAULT 'Ikke navngivet',
            active BOOL NOT NULL DEFAULT 0,
            PRIMARY KEY(id)
        )";

// var_dump($db->query($sql));

$sql2 = "SELECT firstname, lastname FROM people";
$statement = $db->query($sql2, PDO::FETCH_ASSOC);
$result = $statement->fetchAll();

// var_dump($result);

$zipcode = 2300;
$lastname = 'Skov';

$sql = "SELECT email
        FROM people
        WHERE zipcode > :zipcode
        AND lastname = :lastname";
//Deklarer SQL med markers
$statement = $db->prepare($sql);
//Prepare statement
$statement->bindParam(':zipcode', $zipcode);
$statement->bindParam(':lastname', $lastname);

$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);
?>