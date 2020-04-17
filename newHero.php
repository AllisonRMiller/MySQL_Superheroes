<?php
require "heroes.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$newName = $_POST["heroname"]; 
$newBio = $_POST["biography"];
$newAbout = $_POST["aboutme"];
$newAbilities = $_POST["abilities"];
// $newImage = $_POST["newimage"];


// inserting the hero's personal information
$sql = "INSERT INTO heroes (name, about_me, biography) VALUES ('$newName', '$newAbout', '$newBio')";
$result = $conn->query($sql);

if ($result === TRUE) {
    $heroID = $conn->insert_id;
    // inserting new abilities
    foreach ($newAbilities as $ability){
        $sql = "INSERT INTO ability_hero (hero_id, ability_id) VALUES ('$heroID', '$ability')";
        $conn->query($sql);
    }
}



$conn->close();

header("Location: /about.php?id=" . $heroID);


?>