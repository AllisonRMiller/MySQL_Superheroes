<?php
require "heroes.php";
require "header.php";
$id = $_GET["id"];
?>



<div class="col">
    <div class="card">
        <?php
        $sql = "SELECT * FROM heroes WHERE id = " . $id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $profile = "";
            while ($row = $result->fetch_assoc()) {

                $profile .=
                    '<h2 class="card-title">' . $row["name"] . '</h2>
                        <img class="card-img-top" data-src="holder.js/100x180/?text=Image cap" alt="Card image cap"></a>
                        <p class="card-text">' . $row["about_me"] . '</p>';
            }
            echo $profile;
        } else {
            echo "No heroes";
        }
        ?>
        <h3>Abilities</h3>
        <ul class="list-group list-group-flush">
            <?php
            $sql = "SELECT *
                FROM ((abilities
                INNER JOIN ability_hero ON ability_hero.ability_id = abilities.id)
                INNER JOIN heroes ON heroes.id = ability_hero.hero_id)
                WHERE heroes.id=" . $id;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $abilities = "";
                while ($row = $result->fetch_assoc()) {

                    $abilities .=
                        '<li class="list-group-item">' . $row["ability"] . '</li>';
                }
                echo $abilities;
            } else {
                echo "No abilities";
            }


            ?>
        </ul>

        <!-- Friends and enemies here -->
        '<div class="row">
            <div class="col">
                <h3>Friends</h3>
                <ul class="list-group list-group-flush">
                    <?php
                    $sql = "SELECT * FROM relationships
        INNER JOIN heroes
        on relationships.hero2_id=heroes.id
        WHERE (hero1_id=" . $id . ") AND (type_id=1);";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $friends = "";
                        while ($row = $result->fetch_assoc()) {
                            $friend = "about.php?id=" . $row["hero2_id"];
                            $friends .=
                                '<li class="list-group-item"> <a href=' . $friend . '>' . $row["name"] . '</a></li>';
                        }

                        echo $friends;
                    } else {
                        echo "No heroes";
                    }
                    ?>
            </div>
            <div class="col">
                <h3>Enemies</h3>
                <ul class="list-group list-group-flush">
                    <?php
                    $sql = "SELECT * FROM relationships
INNER JOIN heroes
on relationships.hero2_id=heroes.id
WHERE (hero1_id=" . $id . ") AND (type_id=2);";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $enemies = "";
                        while ($row = $result->fetch_assoc()) {
                            $enemy = "about.php?id=" . $row["hero2_id"];
                            $enemies .=
                                '<li class="list-group-item"> <a href=' . $enemy . '>' . $row["name"] . '</a></li>';
                        }

                        echo $enemies;
                    } else {
                        echo "No heroes";
                    }
                    ?>
            </div>
        </div>
    </div>



    <?php
    require "footer.php";
    ?>