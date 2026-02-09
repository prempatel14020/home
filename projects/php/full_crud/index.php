<?php
require_once('private/authentication.php');
$title = "View Characters";
$introduction = "This page displays all my top 30 anime characters and anyone can see this page<br>
                please <b><a href=\"login.php\" class=\"text-light\">login</a></b> to <b><a href=\"insert.php\" class=\"text-success\">Insert</a></b> / <b><a href=\"edit.php\" class=\"text-warning\">Edit</a></b>/ <b><a href=\"delete.php\" class=\"text-danger\">Delete</a></b> this database.";
include 'includes/header.php';
include 'includes/function.php';


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



<?php include 'includes/footer.php'; ?>