<?php
require_once '../private/authentication.php';
require_login();


$title = "Edit a movie record!";
$introduction = "To edit a record in our database, click 'Edit' beside the row you would like to change. Next, add your corrections into the provided form and hit 'Save'.";

include 'includes/header.php';

// These are status messages for the user after they submitted their form.
$message = "";
$alert_class = "alert-danger";

// Check to see if the user chose a city to edit (i.e. if they have a id).
$id = $_GET['id'] ?? $_POST['id'] ?? "";
$movie_id = "";

// If there is a query string, we should fetch the details of the city that the user wants to edit.
$row = ($id != "") ? select_row_by_id($id) : NULL;

// Next, we need to set the value that already exists for a single city (i.e. what's currently in the database), and set any values that the user may have already provided us.
$existing_title = $row['title'] ?? "";
$existing_media_type = $row['media_type'] ?? "";
$existing_release_year = $row['release_year'] ?? "";

$existing_genre1 = $row['genre1'] ?? "";
$existing_genre2 = $row['genre2'] ?? "";
$existing_starring = $row['starring'] ?? "";
$existing_summary = $row['summary'] ?? "";
$existing_watched = $row['watched'] ?? "";
$existing_personal_rating = $row['personal_rating'] ?? "";
$existing_streaming_url = $row['streaming_url'] ?? "";



$user_title = $_POST['title'] ?? "";
$user_media_type = $_POST['media_type'] ?? "";
$user_release_year = $_POST['release_year'] ?? "";

$user_genre1 = $_POST['genre1'] ?? "";
$user_genre2 = $_POST['genre2'] ?? "";
$user_starring = $_POST['starring'] ?? "";
$user_summary = $_POST['summary'] ?? "";
$user_watched = $_POST['watched'] ?? "";
$user_personal_rating = $_POST['personal_rating'] ?? "";
$user_streaming_url = $_POST['streaming_url'] ?? "";


// Process the form data.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $validation_result = validate_record_input($user_title, $user_media_type, $user_release_year, $user_genre1, $user_genre2, $user_starring, $user_summary, $user_watched, $user_personal_rating, $user_streaming_url);

    // Let's check to see if the form data passed validation.
    if ($validation_result['is_valid']) {
        if (update_record($user_title, $user_media_type, $user_release_year, $user_genre1, $user_genre2, $user_starring, $user_summary, $user_watched, $user_personal_rating, $user_streaming_url, $id)) {
            $message = "{$user_title} was updated successfully.";
            $alert_class = "alert-success";
        } else { // If there is something wrong with trying to update the database ...
            $message = "There was an error updating the record.";
        }
    } else { // If we fail validation ...
        $message = implode("<p></p>", $validation_result['errors']);
    }
}
?>

<!-- This is our validation message block. It will only appear when there is a message for the user. -->
<?php if ($message != ""): ?>
    <div class="container col-lg-8 alert <?= $alert_class; ?>" role="alert">
        <?= $message; ?>
    </div>
<?php endif; ?>



<!-- If the City ID is set (i.e. if the user has chosen a city that they would like to edit), we'll show the user a form. This should be high enough up on the page for the user to see when the page refreshes. -->
<?php if ($id != ""): ?>
    <section class="container col-lg-8 my-5 p-3 border">
        <h2 class="fw-light mb-3">You are currently editing: <?= $existing_title ?></h2>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- City Name -->
            <div class="mb-3">
                <label for="title" class="form-label">Movie Name</label>
                <input type="text" id="title" name="title" value="<?= $user_title ?: $existing_title; ?>"
                    class="form-control">
                <p class="form-text">Enter the title of the <?= $existing_media_type ?></p>

            </div>

            <!-- media type -->
            <div class="mb-3">
                <label for="media_type" class="form-label">Media Type</label>
                <input type="text" id="media_type" name="media_type"
                    value="<?= $existing_media_type ?: $existing_media_type; ?>" class="form-control">
                <p class="form-text">Enter the media type of the <?= $existing_media_type ?></p>

            </div>
            <!-- Release Date -->
            <div class="mb-3">
                <label for="release_year" class="form-label">Release Date</label>
                <input type="number" id="release_year" name="release_year"
                    value="<?= $existing_release_year ?: $existing_release_year; ?>" class="form-control">
                <p class="form-text">Enter the release year of the <?= $existing_media_type ?></p>

            </div>
            <!-- Genre 1 -->
            <div class="mb-3">
                <label for="genre1" class="form-label">Genre 1</label>
                <input type="text" id="genre1" name="genre1" value="<?= $existing_genre1 ?: $existing_genre1; ?>"
                    class="form-control">
                <p class="form-text">Enter a first genre of the <?= $existing_media_type ?></p>

            </div>
            <!-- Genre 2 -->
            <div class="mb-3">
                <label for="genre2" class="form-label">Genre 2</label>
                <input type="text" id="genre2" name="genre2" value="<?= $existing_genre2 ?: $existing_genre2; ?>"
                    class="form-control">
                <p class="form-text">Enter the second genre if exist of the <?= $existing_media_type ?></p>

            </div>
            <!-- Starring -->
            <div class="mb-3">
                <label for="starring" class="form-label">Starring</label>
                <input type="text" id="starring" name="starring" value="<?= $existing_starring ?: $existing_starring; ?>"
                    class="form-control">
                <p class="form-text">Enter a cast/starring of the <?= $existing_media_type ?></p>

            </div>
            <!-- summary -->
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <input type="text" id="summary" name="summary" value="<?= $existing_summary ?: $existing_summary; ?>"
                    class="form-control">
                <p class="form-text">Enter a summary of the <?= $existing_media_type ?></p>
            </div>
            <!-- Watched -->
            <div class="mb-3">
                <label for="watched" class="form-label">Watched</label>
                <input type="number" id="watched" name="watched" value="<?= $existing_watched ?: $existing_watched; ?>"
                    class="form-control">
                <p class="form-text">Please use 0 for not watched and 1 for watched</p>
            </div>
            <!-- Personal Rating -->
            <div class="mb-3">
                <label for="personal_rating" class="form-label">Personal Rating</label>
                <input type="number" id="personal_rating" name="personal_rating"
                    value="<?= $existing_personal_rating ?: $existing_personal_rating; ?>" class="form-control">
                <p class="form-text">Please rate out of 5 if you have watched the <?= $existing_media_type ?> otherwise
                    leave it as empty.</p>
            </div>
            <!-- URL -->
            <div class="mb-3">
                <label for="streaming_url" class="form-label">URL</label>
                <input type="url" id="streaming_url" name="streaming_url"
                    value="<?= $existing_streaming_url ?: $existing_streaming_url; ?>" class="form-control">
                <p class="form-text">Please rate out of 5 if you have watched the <?= $existing_media_type ?> otherwise
                    leave it as empty.</p>
            </div>

            <!-- Retaining the Primary Key -->
            <input type="hidden" id="id" name="id" value="<?= $id; ?>">
            <!-- Submit -->
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-warning mt-5">
        </form>
    </section>
<?php endif; ?>

<!-- No matter what state this page is in. we are always going to generate a table with an 'Action' column. -->

<h2 class="fw-light mb-3">Movies in Our System</h2>

<?php
generate_table(function ($row) {
    $id = $row['id'];
    $title = $row['title'];
    return "<a href=\"edit.php?id=" . urlencode($id) . "&title=" . urlencode($title) . "\" class=\"btn btn-warning\">Edit</a>";
});
?>



<?php

include 'includes/footer.php';

?>