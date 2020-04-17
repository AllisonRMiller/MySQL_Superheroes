<?php
require "heroes.php";

$id = $_GET["id"];
$sql = "SELECT * FROM relationships
        INNER JOIN heroes
        on relationships.hero2_id=heroes.id
        WHERE (hero1_id=" .$id . ") AND (type_id=2);";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $enemies = "";
    while ($row = $result->fetch_assoc()) {
        
        $enemies .=
        '<div class="row">
        <div class="col">
        <h3>Enemies</h3>
        <ul>
        <li>' . $row["name"] . '</li>    
        </ul>
        </div>
        </div>';}
        
        echo $enemies;
    }
        else {
            echo "No heroes";
        }


        // SELECT ability
        // FROM ((abilities
        // INNER JOIN ability_hero ON ability_hero.ability_id = ability.id)
        // INNER JOIN heroes ON heroes.hero_id = ability_hero.hero_id);
