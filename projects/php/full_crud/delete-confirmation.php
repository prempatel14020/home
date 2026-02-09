<?php
require_once 'private/authentication.php';

$character_name = isset($_GET['character_name']) ? $_GET['character_name'] : "";
$id = NULL;
$introduction = "";
$message = "";

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = $_GET['id'];
    $message = "<p class=\"lead text-center\">Are you sure that you want to delete " . htmlspecialchars($character_name) . "?</p>";
} else {
    $introduction = "Please return to the 'delete' page and select an option from the table.";
}

$title = "Delete Confirmation";
include 'includes/header.php';
include 'includes/function.php';

if (isset($_POST['confirm'])) {
    $hidden_id = $_POST['hidden-id'];
    $hidden_name = htmlspecialchars($_POST['hidden-character_name']);

    delete_record($hidden_id);
    $message = "<p class=\"lead text-center\">" . $hidden_name . " was deleted from the database.</p>";
}

?>

<?php if ($message != "") {
    echo $message;
} ?>


<?php if ($id != NULL): ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <input type="hidden" id="hidden-id" name="hidden-id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" id="hidden-character_name" name="hidden-character_name"
            value="<?php echo htmlspecialchars($character_name); ?>">


        <input type="submit" id="confirm" name="confirm" value="Yes, I'm sure." class="btn btn-danger d-block mx-auto">
    </form>
<?php endif; ?>

<p class="text-center my-5">
    <a href="delete.php" class="text-link link-light">Return to 'Delete page'</a>
</p>

<?php include 'includes/footer.php'; ?>