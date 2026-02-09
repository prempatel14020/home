<?php


$title = "Welcome!";
$introduction = "Welcome to the Movie collection Database! All of the movies that we currently have listed in our system are down below. Click on any of the buttons above to get started on adding, editing, or deleting any of these entries.";

include 'includes/header.php';

echo "<h2 class=\"fw-light mb-3\">Current Movies Records</h2>";

generate_table();

include 'includes/footer.php';

?>