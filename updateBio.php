<?php
require "heroes.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$newBio = $_POST["biography"];
$heroID = $_GET["id"];


$sql = "UPDATE heroes SET biography=('$newBio') WHERE id=" . $heroID;
$result = $conn->query($sql);
if ($result === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();

header("Location: /about.php?id=" . $heroID);

?>