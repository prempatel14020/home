<?php
require_once '../private/authentication.php';
require_login();


$title = "Delete a record";
$introduction = "To remove a record from our database, click 'Delete' beside the entry you would like to remove. You will then be taken to a confirmation page where you can complete the deletion process.";

include 'includes/header.php';

echo "<h2 class=\"fw-light mb-3\">Current Records in Our System</h2>";

generate_table(function ($row) {
    $id = $row['id'];
    $title = $row['title'];

    return "<a href=\"delete-confirmation.php?id=" . urlencode($id) . "&title=" . urlencode($title) . "\" class=\"btn btn-danger\">Delete</a>";
});

include 'includes/footer.php';

?>