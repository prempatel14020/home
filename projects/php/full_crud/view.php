<?php
require_once('private/authentication.php');
$title = "View Characters";
$introduction = "This page displays anime characters and anyone can see this page<br>
                please <b><a href=\"login.php\" class=\"text-light\">login</a></b> to <b><a href=\"insert.php\" class=\"text-success\">Insert</a></b> / <b><a href=\"edit.php\" class=\"text-warning\">Edit</a></b>/ <b><a href=\"delete.php\" class=\"text-danger\">Delete</a></b> this database.";

include 'includes/header.php';
include 'includes/function.php';



$id = htmlspecialchars($_GET['id'] ?? "");

$query = "SELECT * FROM anime_characters WHERE id = $id;";

$result = $connection->query($query);

if ($result->num_rows > 0) {
    echo '<div class="d-flex gap-2 flex-wrap container justify-content-center mx-auto">';

    while ($row = $result->fetch_assoc()) {
        echo '<div class="card-container shadow minh-100 ">';
        $image_path = "images/thumbs/" . htmlspecialchars($row['image_filename']);
        $full_image_path = "images/full/" . htmlspecialchars($row['image_filename']);
        ?>

        <div class="card bg-light mx-auto " style="min-height: 100%; ">
            <div class="p-2 d-flex  text-wrap">
                <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['character_name']); ?>"
                    class="mx-auto img-fluid card-img-top w-50">
                <div class="card-body w-50 pb-0 pt-0"
                    style=" min-height: 100%; display: flex; justify-content: space-between; flex-direction: column;">
                    <div class="">
                        <h3 class="card-title" style="font-size: 28px;"><strong>Character Name:
                            </strong><?php echo htmlspecialchars($row['character_name']); ?></h3>
                        <p class="card-text" style="font-size: 24px;"><strong>Description:
                            </strong><?php echo htmlspecialchars($row['description']); ?>
                        </p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Anime: </strong>
                            <?php echo htmlspecialchars($row['anime']); ?></p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Total Episodes: </strong>
                            <?php echo htmlspecialchars($row['total_episodes']); ?></p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Personality Type: </strong>
                            <?php echo htmlspecialchars($row['personality_type']); ?></p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Genre: </strong>
                            <?php echo htmlspecialchars($row['genre']); ?></p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Year of Release: </strong>
                            <?php echo htmlspecialchars($row['year_of_release']); ?></p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Voice Actor: </strong>
                            <?php echo htmlspecialchars($row['voice_actor']); ?>
                        </p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Popularity Rating: </strong>
                            <?php echo htmlspecialchars($row['popularity_rating']); ?></p>
                        <p class="card-text" style="font-size: 24px;"> <strong>Date Added: </strong>
                            <?php echo htmlspecialchars($row['date_added']); ?>
                        </p>
                        <p class="card-text" style="font-size: 24px;"><strong>Date Edited: </strong>
                            <?php echo htmlspecialchars($row['date_edited'] ?? "Unedited"); ?></p>
                    </div>
                    <button class="btn btn-primary w-100 p-2 mt-5 "><a href="<?php echo $full_image_path ?> " target="_blank"
                            style="font-size:24px;" class="text-light link nav-link">View Full
                            Image</a></button>
                    <button class="btn btn-secondary w-100 p-2 mt-5 "><a href="<?php echo $row['image_url_src'] ?> "
                            target="_blank" style="font-size:24px;" class="text-light link nav-link">View Image
                            Source</a></button>
                </div>
            </div>
            <div class="d-flex gap-2 p-2 m-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php echo "<button class=\"btn btn-warning w-50 my-3 mx-auto \"><a href='edit.php?id=" . $row['id'] . "' class=\"text-white nav-link p-2 mx-auto\" style=\" font-size:24px; font-weight:bold;\">Edit</a></button>"; ?>
                <?php endif ?>
                <?php echo "<button class=\"btn btn-success w-50 my-3 mx-auto \"><a href='index.php' class=\"text-white nav-link p-2 mx-auto\" style=\" font-size:24px; font-weight:bold;\">Back To Home</a></button>"; ?>
            </div>

        </div>
        <?php
        echo '</div>';


    }
    ?>

    <?php

    echo '</div>';

} else {
    echo '<p>No records found.</p>';
}
?>



<?php include 'includes/footer.php'; ?>