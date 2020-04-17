<?php
require "heroes.php";
$id = $_GET["id"];
$sql = "SELECT *
FROM ((abilities
INNER JOIN ability_hero ON ability_hero.ability_id = abilities.id)
INNER JOIN heroes ON heroes.id = ability_hero.hero_id)
WHERE heroes.id=" .$id;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $abilities = "";
    while ($row = $result->fetch_assoc()) {
        
        $abilities .=
        '<li>' . $row["ability"] . '</li>'
        ;
    }
    echo $abilities;
}
else {echo "No abilities";}



?>