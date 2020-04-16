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
        '<div class="row">
        <div class="col">
        <h3>Abilities</h3>
        <ul>
        <li>' . $row["ability"] . '</li>
        </ul
        </div>
        </div>'
        ;
    }
    echo $abilities;
}
else {echo "No abilities";}

?>