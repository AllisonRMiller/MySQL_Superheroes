<?php
require "heroes.php";
require "header.php";
$id = $_GET["id"];
?>


<div class="col">
    <a href="index.php" class="btn btn-primary">Home Page</a>
    <div class="card">
        <?php
        // Get everything from heroes
        $sql = "SELECT * FROM heroes WHERE id = " . $id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $profile = "";
            // Does this need to be a while?  We are only retrieving one record.
            while ($row = $result->fetch_assoc()) {
                // prep display of everything from heroes
                $profile .=
                    '<h2 class="card-title">' . $row["name"] . '</h2>
                        <img class="card-img" data-src=' . $row["image_url"] . ' alt="Card image"></a>
                        <p class="card-text bg-light">' . $row["about_me"] . '</p>
                        <hr>
                        <p class="card-text">' . $row["biography"] . '</p>';
            }
            // display everything from heroes
            echo $profile;
        } else {
            // if there's no data
            echo "No heroes";
        }
        ?>
        <!-- Form to update bio--put this behind an accordion? -->
        <form action=<?php echo '"updateBio.php?id=' . $id . '"' ?> method="post">
            <div class="form-group">
                <label for="updateBio">Update Bio</label>
                <textarea class="form-control" name="biography" id="biography" rows="3" placeholder="Tell us all about your origin story here"></textarea>
            </div>
            <button type="Submit" class="btn btn-secondary">Update</button>
        </form>
        <!-- Display abilities, same format as displaying hero info -->
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
        <!-- Form that allows user to update abilities. This accepts both add and delete input -->
        <form action=<?php echo '"changePowers.php?id=' . $id . '"' ?> method="post">
            <div class="form-group">
                <label for="newhero2">Update Powers</label>
                <select multiple="multiple" class="form-control" name="abilities[]" id="abilities">
                    <?php
                    $sql = "SELECT * FROM abilities";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["ability"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <!-- Friends and enemies here -->
        <div class="row">
            <div class="col">
                <h3>Allies</h3>
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
                        echo '<p>You have no allies....</p>';
                    }
                    ?>
                    <!-- <button type="button" action="changeFriend.php" method="post" class="btn btn-secondary">Change Allies</button> -->
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
                        echo '<p>You have no enemies...</p>';
                    }
                    ?>
                    <!-- <button type="button" class="btn btn-secondary">Change Enemies</button> -->
            </div>
        </div>
    </div>



    <?php
    require "footer.php";
    ?>