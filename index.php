<?php
require "heroes.php";
require "header.php";

$id = $_GET["id"];

?>

<div class="col">
    <ul>
        <?php
        $sql = "SELECT * FROM heroes";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $output = "";
            while ($row = $result->fetch_assoc()) {
                $hero = "about.php?id=" . $row["id"];
                $output .=
                    '<li>
                    <div class="card">
                        <a href=' . $hero . '><h4 class="card-title">' . $row["name"] . '</h4>
                        <img class="card-img-top" data-src="holder.js/100x180/?text=Image cap" alt="Card image cap"></a>
                        </div>
                    </li>';
            }
            echo $output;
        } else {
            echo "No heroes";
        }
        ?>
    </ul>
</div>
</div>
<div class="row">
    <div class="col">

        <form action="newHero.php" method="post">
            <div class="form-group">
                <label for="newhero1">Superhero Name</label>
                <input type="text" class="form-control" name="heroname" id="heroname" placeholder="">
            </div>
            <!--T* Look at name="abilities[]"--this is telling the query it is receiving an array.  
            Note the value entry inside the echo as well, returning the ID of the ability in a retrievable format. 
            Now go look at newHero.php -->
            <div class="form-group">
                <label for="newhero2">Powers</label>
                <select multiple="multiple" class="form-control" name="abilities[]" id="abilities">
                    <?php
                    $sql = "SELECT * FROM abilities";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' .$row["id"] .'">' . $row["ability"] . '</option>';
                        }
                    }
                    ?>

                </select>
            </div>
            <div class="form-group">
                <label for="newhero3">Tag Line</label>
                <textarea class="form-control" name="aboutme" id="aboutme" rows="1" placeholder="A quick line to catch the attention of heroes, villains, and fans"></textarea>
            </div>
            <div class="form-group">
                <label for="newhero4">Bio</label>
                <textarea class="form-control" name="biography" id="biography" rows="3" placeholder="Tell us all about your origin story here"></textarea>
            </div>
                <div class="form-group">
                    <label for="newhero5">Avatar</label>
                    <input type="file" class="form-control-file" name="newimage" id="newimage">
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
    require "footer.php";
    ?>