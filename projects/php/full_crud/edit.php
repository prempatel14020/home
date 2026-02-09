<?php
require_once 'private/authentication.php';
require_login();


$title = "Edit An Anime Character Details!";
$introduction = "To edit a record in our database, click 'Edit' on the record you would like to change. Next, add your corrections into the provided form and hit 'Save'.";

include 'includes/header.php';
include 'includes/function.php';


$message = "";
$alert_class = "alert-danger";

$id = $_GET['id'] ?? $_POST['id'] ?? "";

$row = ($id != "") ? select_row_by_id($id) : NULL;

// the values that already exist
$existing_character_name = $row['character_name'] ?? "";
$existing_description = $row['description'] ?? "";
$existing_anime = $row['anime'] ?? "";
$existing_total_episodes = $row['total_episodes'] ?? "";
$existing_personality_type = $row['personality_type'] ?? "";
$existing_genre = $row['genre'] ?? "";
$existing_genre_2 = $row['genre_2'] ?? "";
$existing_year_of_release = $row['year_of_release'] ?? "";
$existing_voice_actor = $row['voice_actor'] ?? "";
$existing_popularity_rating = $row['popularity_rating'] ?? "";
$existing_date_added = $row['date_added'] ?? "";
$existing_date_edited = $row['date_edited'] ?? "";

// User input from the form
$user_character_name = $_POST['character_name'] ?? "";
$user_description = $_POST['description'] ?? "";
$user_anime = $_POST['anime'] ?? "";
$user_total_episodes = $_POST['total_episodes'] ?? "";
$user_personality_type = $_POST['personality_type'] ?? "";
$user_genre = $_POST['genre'] ?? "";
$user_genre_2 = $_POST['genre_2'] ?? "";
$user_year_of_release = $_POST['year_of_release'] ?? "";
$user_voice_actor = $_POST['voice_actor'] ?? "";
$user_popularity_rating = $_POST['popularity_rating'] ?? "";
$date = date('Y-m-d');



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $validation_result = validate_user_input(
        $user_character_name,
        $user_anime,
        $user_total_episodes,
        $user_description,
        $user_personality_type,
        $user_genre,
        $user_genre_2,
        $user_year_of_release,
        $user_voice_actor,
        $user_popularity_rating
    );


    if ($validation_result['is_valid']) {
        if (
            update_record(
                $user_character_name,
                $user_anime,
                $user_total_episodes,
                $user_description,
                $user_personality_type,
                $user_genre,
                $user_genre_2,
                $user_year_of_release,
                $user_voice_actor,
                $user_popularity_rating,
                $id
            )
        ) {
            $message = "{$user_character_name} was updated successfully.";
            $alert_class = "alert-success";
        } else {
            $message = "There was an error updating the record.";
            $alert_class = "alert-danger";
        }
    } else if (is_array($validation_result['errors'])) {
        $message = implode("<p></p>", $validation_result['errors']);
        $alert_class = "alert-danger";

    } else {
        $message = "An unexpected error occurred.";
    }
}

?>
<?php if ($message != ""): ?>
    <div class="container col-lg-8 alert <?= $alert_class; ?>" role="alert">
        <?= $message; ?>
    </div>
<?php endif; ?>




<!-- If the City ID is set (i.e. if the user has chosen a city that they would like to edit), we'll show the user a form. This should be high enough up on the page for the user to see when the page refreshes. -->
<?php if ($id != ""): ?>
    <section class="container col-lg-8 my-5 p-3 border">
        <h2 class="fw-light mb-3">You are currently editing: <?= $existing_character_name ?></h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- Character Name -->
            <div class="mb-3">
                <label for="character_name" class="form-label">Character Name</label>
                <input type="text" id="character_name" name="character_name"
                    value="<?= htmlspecialchars($user_character_name ?: $existing_character_name); ?>" class="form-control">
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description"
                    class="form-control"><?= htmlspecialchars($user_description ?: $existing_description); ?></textarea>
            </div>

            <!-- Anime -->
            <div class="mb-3">
                <label for="anime" class="form-label">Anime</label>
                <input type="text" id="anime" name="anime" value="<?= htmlspecialchars($user_anime ?: $existing_anime); ?>"
                    class="form-control">
            </div>

            <!-- Total Episodes -->
            <div class="mb-3">
                <label for="total_episodes" class="form-label">Total Episodes</label>
                <input type="number" id="total_episodes" name="total_episodes"
                    value="<?= htmlspecialchars($user_total_episodes ?: $existing_total_episodes); ?>" class="form-control">
            </div>

            <!-- Personality Type -->
            <div class="mb-3">
                <label for="personality_type" class="form-label">Personality Type</label>
                <input type="text" id="personality_type" name="personality_type"
                    value="<?= htmlspecialchars($user_personality_type ?: $existing_personality_type); ?>"
                    class="form-control">
            </div>

            <!-- Genre -->
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <select id="genre" name="genre" class="form-control">
                    <option value="">Select Genre</option>
                    <option value="Shonen" <?= ($user_genre === "Shonen" || $existing_genre === "Shonen") ? 'selected' : ''; ?>>
                        Shonen</option>
                    <option value="Shojo" <?= ($user_genre === "Shojo" || $existing_genre === "Shojo") ? 'selected' : ''; ?>>
                        Shojo</option>
                    <option value="Seinen" <?= ($user_genre === "Seinen" || $existing_genre === "Seinen") ? 'selected' : ''; ?>>
                        Seinen</option>
                    <option value="Josei" <?= ($user_genre === "Josei" || $existing_genre === "Josei") ? 'selected' : ''; ?>>
                        Josei</option>
                    <option value="Isekai" <?= ($user_genre === "Isekai" || $existing_genre === "Isekai") ? 'selected' : ''; ?>>
                        Isekai</option>
                    <option value="Slice of Life" <?= ($user_genre === "Slice of Life" || $existing_genre === "Slice of Life") ? 'selected' : ''; ?>>Slice of Life</option>
                    <option value="Fantasy" <?= ($user_genre === "Fantasy" || $existing_genre === "Fantasy") ? 'selected' : ''; ?>>Fantasy</option>
                    <option value="Adventure" <?= ($user_genre === "Adventure" || $existing_genre === "Adventure") ? 'selected' : ''; ?>>Adventure</option>
                    <option value="Romance" <?= ($user_genre === "Romance" || $existing_genre === "Romance") ? 'selected' : ''; ?>>Romance</option>
                    <option value="Horror" <?= ($user_genre === "Horror" || $existing_genre === "Horror") ? 'selected' : ''; ?>>
                        Horror</option>
                </select>
            </div>

            <!-- Genre 2 -->
            <div class="mb-3">
                <label for="genre_2" class="form-label">Genre 2</label>
                <select id="genre_2" name="genre_2" class="form-control">
                    <option value="">Select Genre 2</option>
                    <option value="Shonen" <?= ($user_genre_2 === "Shonen" || $existing_genre_2 === "Shonen") ? 'selected' : ''; ?>>
                        Shonen</option>
                    <option value="Shojo" <?= ($user_genre_2 === "Shojo" || $existing_genre_2 === "Shojo") ? 'selected' : ''; ?>>
                        Shojo</option>
                    <option value="Seinen" <?= ($user_genre_2 === "Seinen" || $existing_genre_2 === "Seinen") ? 'selected' : ''; ?>>
                        Seinen</option>
                    <option value="Josei" <?= ($user_genre_2 === "Josei" || $existing_genre_2 === "Josei") ? 'selected' : ''; ?>>
                        Josei</option>
                    <option value="Isekai" <?= ($user_genre_2 === "Isekai" || $existing_genre_2 === "Isekai") ? 'selected' : ''; ?>>
                        Isekai</option>
                    <option value="Slice of Life" <?= ($user_genre_2 === "Slice of Life" || $existing_genre_2 === "Slice of Life") ? 'selected' : ''; ?>>Slice of Life</option>
                    <option value="Fantasy" <?= ($user_genre_2 === "Fantasy" || $existing_genre_2 === "Fantasy") ? 'selected' : ''; ?>>Fantasy</option>
                    <option value="Adventure" <?= ($user_genre_2 === "Adventure" || $existing_genre_2 === "Adventure") ? 'selected' : ''; ?>>Adventure</option>
                    <option value="Romance" <?= ($user_genre_2 === "Romance" || $existing_genre_2 === "Romance") ? 'selected' : ''; ?>>Romance</option>
                    <option value="Horror" <?= ($user_genre_2 === "Horror" || $existing_genre_2 === "Horror") ? 'selected' : ''; ?>>
                        Horror</option>
                </select>
            </div>

            <!-- Year of Release -->
            <div class="mb-3">
                <label for="year_of_release" class="form-label">Year of Release</label>
                <input type="number" id="year_of_release" name="year_of_release"
                    value="<?= htmlspecialchars($user_year_of_release ?: $existing_year_of_release); ?>"
                    class="form-control">
            </div>

            <!-- Voice Actor -->
            <div class="mb-3">
                <label for="voice_actor" class="form-label">Voice Actor</label>
                <input type="text" id="voice_actor" name="voice_actor"
                    value="<?= htmlspecialchars($user_voice_actor ?: $existing_voice_actor); ?>" class="form-control">
            </div>

            <!-- Popularity Rating -->
            <div class="mb-3">
                <label for="popularity_rating" class="form-label">Popularity Rating</label>
                <input type="number" id="popularity_rating" name="popularity_rating"
                    value="<?= htmlspecialchars($user_popularity_rating ?: $existing_popularity_rating); ?>"
                    class="form-control">
            </div>


            <input type="hidden" id="id" name="id" value="<?= htmlspecialchars($id); ?>">

            <!-- Submit -->
            <input type="submit" id="submit" name="submit" value="Save" class="btn btn-warning mt-5">
        </form>
    </section>
<?php endif; ?>

<?php

// How many results do we want to show per page? We'll check the form, the query string, and have a default value.
$per_page = $_POST['number-of-results'] ?? $_GET['number-of-results'] ?? 6;

$total_count = count_records();

// We are rounding up here because if we have a partial page (i.e. a remainder after our division), we still need to display it on a full page.
$total_pages = ceil($total_count / $per_page);

// Let's make sure the page that we're currently on actually exists. If it isn't set or if it isn't an integer, we'll default to the first page. 
$current_page = (int) ($_GET['page'] ?? 1);

// Because this is a query string, we need to make sure the user hasn't mucked around with it.
if ($current_page < 1 || $current_page > $total_pages || !is_int($current_page)) {
    // If the current page number is negative, is greater than the total number of pages, or if it isn't an integer, we'll kick the user back to the first page.
    $current_page = 1;
}

// The offset lets us know which set of records to retrieve. 
$offset = $per_page * ($current_page - 1);


$query = "SELECT * FROM anime_characters LIMIT $offset, $per_page";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    echo '<div class="d-flex gap-2 flex-wrap container justify-content-center mx-auto">';


    while ($row = $result->fetch_assoc()) {
        echo '<div class="card-container shadow minh-100 ">';
        $image_path = "images/thumbs/" . htmlspecialchars($row['image_filename']);

        ?>

        <div class="card bg-light mx-auto "
            style="min-height: 100%; max-width: 425px; display:flex; flex-direction: column; justify-content: space-between;">
            <div class="p-2  text-wrap"
                style="display: flex; flex-direction:column; justify-content: space-between; min-height: 100%;">
                <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['character_name']); ?>"
                    class="mx-auto img-fluid card-img-top">
                <div class="card-body" style=" min-height: 100%;">
                    <h3 class="card-title"><strong>
                            <?php echo htmlspecialchars($row['character_name']); ?></strong></h3>
                    <p class="card-text"><strong>Description: </strong><?php echo htmlspecialchars($row['description']); ?></p>
                    <p class="card-text"><strong>Anime: </strong> <?php echo htmlspecialchars($row['anime']); ?></p>
                    <p class="card-text"><strong>Total Episodes: </strong>
                        <?php echo htmlspecialchars($row['total_episodes']); ?></p>
                </div>
            </div>
            <div class="d-flex gap-2 p-2 m-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php echo "<button class=\"btn btn-warning w-50 my-3 mx-auto \"><a href='edit.php?id=" . $row['id'] . "' class=\"text-white nav-link p-2 mx-auto\" style=\" font-size:24px; font-weight:bold;\">Edit</a></button>"; ?>
                <?php endif ?>
                <?php echo "<button class=\"btn btn-success w-50 my-3 mx-auto \"><a href='view.php?id=" . $row['id'] . "' class=\"text-white nav-link p-2 mx-auto\" style=\" font-size:24px; font-weight:bold;\">View</a></button>"; ?>
            </div>

        </div>
        <?php
        echo '</div>';


    }
    ?>
    <nav aria-label="Page Number" class="mt-5">
        <ul class="pagination justify-content-center">

            <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a href="index.php?page=<?= $current_page - 1; ?>&number-of-results=<?= $per_page; ?>"
                        class="page-link link-dark">Previous</a>
                </li>
            <?php endif;

            $gap = FALSE;

            $window = 1;

            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i > 1 + $window && $i < $total_pages - $window && abs($i - $current_page) > $window) {
                    if (!$gap): ?>

                        <li class="page-item"><span class="page-link link-dark">...</span></li>

                    <?php endif;
                    $gap = TRUE;
                    continue;
                }

                $gap = FALSE;

                if ($current_page == $i): ?>
                    <li class="page-item bg-dark active">
                        <a href="#" class="page-link bg-dark link-white border border-light"><?= $i; ?></a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a href="index.php?page=<?= $i; ?>&number-of-results=<?= $per_page; ?>"
                            class="page-link link-dark"><?= $i; ?></a>
                    </li>
                <?php endif;
            }
            ?>

            <?php if ($current_page < $total_pages): ?>
                <li class="page-item">
                    <a href="index.php?page=<?= $current_page + 1; ?>&number-of-results=<?= $per_page; ?>"
                        class="page-link link-dark">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php

    echo '</div>';

} else {
    echo '<p>No records found.</p>';
}
?>



<?php

include 'includes/footer.php';

?>