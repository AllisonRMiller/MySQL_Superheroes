<?php
require "heroes.php";
require "header.php";


//Ask about multi-query
$id = $_GET["id"];
$sql = "SELECT * FROM heroes WHERE id = " .$id;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $profile = "";
    while ($row = $result->fetch_assoc()) {
        
        $profile .=
            '<div class="col">
            <div class="card">        
            <h4 class="card-title">' . $row["name"] . '</h4>
                        <img class="card-img-top" data-src="holder.js/100x180/?text=Image cap" alt="Card image cap"></a>
                        <p class="card-text">' . $row["about_me"] . '</p>

            </div>
            </div>';
    }
    echo $profile;
} else {
    echo "No heroes";
}

require "abilities.php";
require "friends.php";
require "enemies.php";
        
require "footer.php";
