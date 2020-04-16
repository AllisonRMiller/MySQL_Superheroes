<?php
require "heroes.php";
require "header.php";




$id = $_GET["id"];
$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $output = "";
    while ($row = $result->fetch_assoc()) {
        $hero = "about.php?id=" . $row["id"];
        $output .=
            '<div class="col">
                    <ul>
                    <li>
                       <a href=' . $hero . ' <h4 class="card-title">' . $row["name"] . '</h4>
                        <img class="card-img-top" data-src="holder.js/100x180/?text=Image cap" alt="Card image cap"></a>
                    </li>
                    </ul>
            </div>';
    }
    echo $output;
} else {
    echo "No heroes";
}



require "footer.php";
?>
