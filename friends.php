<?php
require "heroes.php";

$id = $_GET["id"];
$sql = "SELECT * FROM relationships
        INNER JOIN heroes
        on relationships.hero2_id=heroes.id
        WHERE (hero1_id=" .$id . ") AND (type_id=1);";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $friends = "";
    while ($row = $result->fetch_assoc()) {
        
        $friends .=
        '<div class="row">
        <div class="col">
        <h3>Friends</h3>
        <ul>
        <li>' . $row["name"] . '</li>    
        </ul>
        </div>
        </div>';}
        
        echo $friends;
    }
        else {
            echo "No heroes";
        }



