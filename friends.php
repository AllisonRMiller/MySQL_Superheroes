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
        <div class="card">        
        <h4 class="card-title">' . $row["name"] . '</h4>    
        </div>
        </div>
        </div>';}
        
        echo $friends;
    }
        else {
            echo "No heroes";
        }



