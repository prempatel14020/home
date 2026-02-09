<?php

$title = "Comic Details: The Comic Chronicler";
include('includes/header.php');
include('includes/functions.php');


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $comic_id = (int) $_GET['id'];
    $query = "SELECT * FROM lab05_comic_books WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $comic_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<main class="container flex-column d-flex align-items-center">
    <?php
    if ($result->num_rows > 0):
        $comic = $result->fetch_assoc();
        ?>
        <div class="card col-md-10 col-lg-8 col-xxl-6">
            <h2 class="card-title display-4 bg-danger p-2 text-light fw-700"><?= $comic['title']; ?></h2>
            <div class="card-body">
                <p class="card-text"><strong>Writer:</strong> <?= $comic['writer']; ?></p>
                <p class="card-text"><strong>Artist:</strong> <?= $comic['artist']; ?></p>
                <p class="card-text"><strong>Synopsis:</strong> <?= $comic['synopsis']; ?></p>
                <p class="card-text"><strong>Publisher:</strong> <?= $comic['publisher']; ?></p>
                <p class="card-text"><strong>Year:</strong> <?= $comic['year']; ?></p>
                <p class="card-text"><strong>Genre:</strong> <?= $comic['genre']; ?></p>
                <p class="card-text"><strong>Characters:</strong> <?= $comic['characters']; ?></p>
                </p>
            </div>
        </div>
        <a href="index.php" class=" btn btn-danger mx-auto my-5">Back to Index</a>
    <?php else:
        echo '<div class="container col col-md-8 col-lg-6 align-items-top alert alert-danger">Comic book not found.</div>';
        ?>
    <?php endif ?>
</main>

<?php

include('includes/footer.php');

?>