<?php
require_once '../private/authentication.php';

require_login();


$title = "Add a record";
$introduction = "To add a new entry to our movies database, simply fill out the form below and hit 'Save'.";

include 'includes/header.php';

$message = "";
$alert_class = "alert-danger";


$title = isset($_POST['title']) ? $_POST['title'] : "";
$media_type = isset($_POST['media-type']) ? $_POST['media-type'] : "";
$release_year = isset($_POST['release-year']) ? $_POST['release-year'] : "";
$genre1 = isset($_POST['genre1']) ? $_POST['genre1'] : "";
$genre2 = isset($_POST['genre2']) ? $_POST['genre2'] : "";
$starring = isset($_POST['starring']) ? $_POST['starring'] : "";
$summary = isset($_POST['summary']) ? $_POST['summary'] : "";
$watched = isset($_POST['watched']) ? $_POST['watched'] : "";
$personal_rating = isset($_POST['personal-rating']) ? $_POST['personal-rating'] : "";
$streaming_url = isset($_POST['streaming-url']) ? $_POST['streaming-url'] : "";



if (isset($_POST['submit'])) {
    // We'll call our validation function here. Remember that the array with the provincial abbreviations is in the validation script. 
    $validation_result = validate_record_input($title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url);

    if ($validation_result['is_valid']) {
        // If our data is valid, we will call our insert data function.
        $data = $validation_result['data'];

        if (insert_record($title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url)) {

            $message = "Your new $media_type was successfully added to our database!";
            $alert_class = "alert-success";

            // After successfully inserting all of the data from our form, let's wipe out the values so that the user doesn't spam-add the same city over and over again.
            $title = $media_type = $release_year = $genre1 = $genre2 = $starring = $summary = $watched = $personal_rating = $streaming_url = "";

        } else {
            $message = "There was a problem adding the record: " . $connection->error;
        }

    } else {
        // If the data is not valid, we'll show the user some errors.
        $message = implode("<p></p>", $validation_result['errors']);
    }
}

?>

<h2 class="container col-lg-8 fw-light mb-3">New Entry: Enter Record Details Below</h2>

<?php if ($message != ""): ?>
    <div class="container col-lg-8 alert <?= $alert_class; ?>" role="alert">
        <?= $message; ?>
    </div>
<?php endif; ?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="container col-lg-8">
    <!-- Title Name -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $title; ?>">
        <p class="form-text">Enter the title</p>

    </div>

    <!-- Media Type -->
    <div class="mb-3">
        <label for="media-type" class="form-label">Media Type</label>
        <input type="text" name="media-type" id="media-type" class="form-control" value="<?php echo $media_type; ?>">
        <p class="form-text">Enter the media type</p>

    </div>

    <!-- Release Year -->
    <div class="mb-3">
        <label for="release-year" class="form-label">Release Year</label>
        <input type="number" name="release-year" id="release-year" class="form-control"
            value="<?php echo $release_year; ?>">
        <p class="form-text">Enter the release year</p>

    </div>

    <!-- Genre 1 -->
    <div class="mb-3">
        <label for="genre1" class="form-label">Genre 1</label>
        <input type="text" name="genre1" id="genre1" class="form-control" value="<?php echo $genre1; ?>">
        <p class="form-text">Enter a first genre</p>

    </div>

    <!-- Genre 2 -->
    <div class="mb-3">
        <label for="genre2" class="form-label">Genre 2</label>
        <input type="text" name="genre2" id="genre2" class="form-control" value="<?php echo $genre2; ?>">
        <p class="form-text">Enter the second genre if exist(optional)</p>

    </div>

    <!-- Starring -->
    <div class="mb-3">
        <label for="starring" class="form-label">Starring</label>
        <input type="text" name="starring" id="starring" class="form-control" value="<?php echo $starring; ?>">
        <p class="form-text">Enter a cast/starring</p>

    </div>

    <!-- Summary -->
    <div class="mb-3">
        <label for="summary" class="form-label">Summary</label>
        <textarea name="summary" id="summary" class="form-control" rows="3"><?php echo $summary; ?></textarea>
        <p class="form-text">Enter a summary</p>

    </div>

    <!-- Watched -->
    <div class="mb-3">
        <label for="watched" class="form-label">Watched</label>
        <input type="number" name="watched" id="watched" class="form-control" value="<?php echo $watched; ?>" min="0"
            max="1">

        <p class="form-text">Please use 0 for not watched and 1 for watched</p>

    </div>

    <!-- Personal Rating -->
    <div class="mb-3">
        <label for="personal-rating" class="form-label">Personal Rating (1-5)</label>
        <input type="number" name="personal-rating" id="personal-rating" class="form-control"
            value="<?php echo $personal_rating; ?>" max="5">
        <p class="form-text">Please rate out of 5 if you have watched the new entry otherwise
            leave it as empty.</p>

    </div>

    <!-- Streaming URL -->
    <div class="mb-3">
        <label for="streaming-url" class="form-label">Streaming URL</label>
        <input type="url" name="streaming-url" id="streaming-url" class="form-control"
            value="<?php echo $streaming_url; ?>">
        <p class="form-text">Please rate out of 5 if you have watched otherwise
            leave it as empty.</p>
    </div>

    <!-- Submit -->
    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
</form>


<?php

include 'includes/footer.php';

?>