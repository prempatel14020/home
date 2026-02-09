<?php
require_once '../private/authentication.php';


$title = isset($_GET['title']) ? $_GET['title'] : "";
$id = NULL;
$introduction = "";
$message = "";

/**
 * This block checks to see if the primary key in the query string:
 * 1. exists
 * 2. is a number
 * 3. is a positive number
 */
if (isset($_GET['title']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $message = "<p class=\"lead text-center\">Are you sure that you want to delete " . $title . "?</p>";
} else {
    $introduction = "Please return to the 'delete' page and select an option from the table.";
}

$title = "Delete Confirmation";
include 'includes/header.php';

// Hitting the big red button wipes the query string, so this actually needs to be its own code block (not inside of the other if statement above).
if (isset($_POST['confirm'])) {
    $hidden_id = $_POST['hidden-id'];
    $hidden_name = $_GET['title'];

    delete_record($hidden_id);
    $message = "<p class=\"lead text-center\">" . $hidden_name . " was deleted from the database.</p>";
}

?>

<!-- If there's a message for the user, let's display it. -->
<?php if ($message != "") {
    echo $message;
} ?>

<!-- We will give the user the option to delete their title only if they have a valid primary key. -->
<?php if ($id != NULL): ?>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <!-- Hidden -->
        <input type="hidden" id="hidden-id" name="hidden-id" value="<?php echo $id; ?>">
        <input type="hidden" id="hidden-title" name="hidden-title" value="<?php echo $title; ?>">

        <!-- Confirmation Button -->
        <input type="submit" id="confirm" name="confirm" value="Yes, I'm sure." class="btn btn-danger d-block mx-auto">
    </form>
<?php endif; ?>

<!-- No matter what state this page in, we need to make sure that the user always has the option to go back to the Delete page. -->
<p class="text-center my-5">
    <a href="delete.php" class="text-link link-dark">Return to 'Delete a title'</a>
</p>

<?php include 'includes/footer.php'; ?>