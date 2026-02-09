<?php
require_once('private/authentication.php');
$title = "View Characters";
$introduction = "This page displays all my top 30 anime characters and anyone can see this page<br>
                please <b><a href=\"login.php\" class=\"text-light\">login</a></b> to <b><a href=\"insert.php\" class=\"text-success\">Insert</a></b> / <b><a href=\"edit.php\" class=\"text-warning\">Edit</a></b>/ <b><a href=\"delete.php\" class=\"text-danger\">Delete</a></b> this database.";

include 'includes/header.php';
include 'includes/function.php';
$keyword_for_count = $_GET['keyword'] ?? '';

$per_page = $_POST['number-of-results'] ?? $_GET['number-of-results'] ?? 6;

$total_count = search_result_count($keyword_for_count);

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

if (isset($_GET['keyword'])) {
    $keyword = $connection->real_escape_string($_GET['keyword']);
    $keyword_message = $keyword;
    $keyword = '%' . $keyword . '%';


    $query = "SELECT * FROM anime_characters WHERE 
    character_name LIKE '$keyword' OR 
    anime LIKE '$keyword' OR 
    description LIKE '$keyword' OR 
    personality_type LIKE '$keyword' OR 
    genre LIKE '$keyword' OR 
    genre_2 LIKE '$keyword' OR 
    voice_actor LIKE '$keyword'
    LIMIT $per_page OFFSET $offset;";


    $result = $connection->query($query);



    if ($result->num_rows > 0) {
        echo '<div class="container mx-auto">';
        echo '<table class="table table-bordered table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Character Name</th>';
        echo '<th>Description</th>';
        echo '<th>Anime</th>';
        echo '<th>Total Episodes</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';


        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['character_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
            echo '<td>' . htmlspecialchars($row['anime']) . '</td>';
            echo '<td>' . htmlspecialchars($row['total_episodes']) . '</td>';
            echo '<td class="text-center">';

            if (isset($_SESSION['user_id'])) {
                echo "<button class=\"btn btn-warning mx-1\"><a href='edit.php?id=" . $row['id'] . "' class=\"text-white nav-link p-2\" style=\"font-size: 16px; font-weight: bold;\">Edit</a></button>";
            }
            echo "<button class=\"btn btn-success mx-1\"><a href='view.php?id=" . $row['id'] . "' class=\"text-white nav-link p-2\" style=\"font-size: 16px; font-weight: bold;\">View</a></button>";

            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        if ($total_count > $per_page) {

            ?>
            <nav aria-label="Page Number" class="mt-5">
                <ul class="pagination justify-content-center">

                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                            <a href="search_results.php?page=<?= $current_page - 1; ?>&number-of-results=<?= $per_page; ?>&keyword=<?= $keyword_message ?>"
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
                                <a href="search_results.php?page=<?= $i; ?>&number-of-results=<?= $per_page; ?>&keyword=<?= $keyword_message ?>"
                                    class="page-link link-dark"><?= $i; ?></a>
                            </li>
                        <?php endif;
                    }
                    ?>

                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                            <a href="search_results.php?page=<?= $current_page + 1; ?>&number-of-results=<?= $per_page; ?>&keyword=<?= $keyword_message ?>"
                                class="page-link link-dark">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php
        }
        echo '</div>';
    } else { ?>
        <div class="container">
            <p class="h1">No results found for '<strong>" <?= htmlspecialchars($keyword_message) ?> "</strong>'.</p>
        </div>
        <?php
    }
} else { ?>
    <div class="container">
        <p class="h1"> No keyword provided in the URL.</p>
    </div>
    <?php

}
?>