<?php
require "heroes.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$newAbilities = $_POST["abilities"];
$heroID = $_GET["id"];

// var_dump("the whole post: ", $newAbilities);
// var_dump("ID: ",$heroID, "<br>");
// retrieve hero's current abilities
// compare to received abilities
// if it already exists, delete
// if it doesn't, add
$sql = "SELECT * FROM ability_hero WHERE hero_id=" . $heroID;
$result = $conn->query($sql);
// var_dump("result status: ",$result, "<br>");
$currentAbilities = [];
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $currentAbilities[] = $row["ability_id"];
    }
}
// var_dump("current Abilities: ",$currentAbilities, "<br>");

$additions = array_diff($newAbilities, $currentAbilities);
// var_dump("the differences only from new abilities: ", $additions, "<br>");

if (empty($additions)===FALSE){
foreach ($additions as $ability){
    $sql = "INSERT INTO ability_hero (hero_id, ability_id) VALUES ('$heroID', '$ability')";
    $conn->query($sql);
}
}

$subtractions = array_diff($newAbilities, $additions);
// var_dump("subtractions: ",$subtractions);
if (empty($subtractions)===FALSE){
foreach ($subtractions as $ability){
    $sql = "DELETE FROM ability_hero WHERE hero_id = $heroID AND ability_id = $ability";
    $conn->query($sql);
}
}
$conn->close();

header("Location: /about.php?id=" . $heroID);

?>