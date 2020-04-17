<?php
require "heroes.php";

$newName = $_POST["heroname"]; 
$newBio = $_POST["biography"];
$newAbout = $_POST["aboutme"];
$newAbilities = $_POST["abilities"];
$newImage = $_POST["newimage"];

$sql = "INSERT INTO heroes (name, about_me, biography, image_url) VALUES ('$newName', '$newAbout', '$newBio', '$newImage')";
$result = $conn->query($sql);

if ($result === TRUE) {
    $last_id = $conn->insert_id;
    echo $last_id;
}

// T* You  have to loop over every entry you received in the array abilities here, inserting each one into ability_hero
foreach ($newAbilities as $ability){
    $sql = "INSERT INTO ability_hero (hero_id, ability_id) VALUES ('$last_id', '$ability')";
    $conn->query($sql);
}


$conn->close();

header("Location: /about.php?id=" . $last_id);


?>