<?php

$title = "Filter: Publisher";
include('includes/header.php');
include 'includes/functions.php';

$query = "SELECT DISTINCT publisher FROM lab05_comic_books";
$result = $connection->query($query);
$options = [];

while ($row = $result->fetch_assoc()) {
    $options[] = $row['publisher'];
}

$selected_publisher = isset($_POST['publisher']) ? $_POST['publisher'] : '';

?>

<main class="container">
    <section class="row justify-content-center mb-5">
        <div class="col col-md-10 col-xl-8">
            <h2 class="display-3"><?php echo $title; ?></h2>
            <div class="d-flex flex-wrap justify-content-center">
                <?php foreach ($options as $option): ?>
                    <form method="POST" class="m-2">
                        <input type="hidden" name="publisher" value="<?= htmlspecialchars($option); ?>">
                        <button type="submit" class="btn btn-danger">
                            <?= htmlspecialchars($option); ?>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>

            <?php if ($selected_publisher): ?>
                <h3 class="mt-4">Results for <?= htmlspecialchars($selected_publisher); ?></h3>
                <?php

                $query = "SELECT * FROM lab05_comic_books WHERE publisher = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param('s', $selected_publisher);
                $stmt->execute();
                $results = $stmt->get_result();

                if ($results->num_rows > 0): ?>
                    <div class="mt-4">
                        <?php while ($row = $results->fetch_assoc()): ?>
                            <div class="border-bottom p-3 mb-3">
                                <h3> <?= $row['title']; ?></h3>
                                <p>Writer: <?= $row['writer']; ?></p>
                                <p>Artist: <?= $row['artist']; ?></p>
                                <p>Publisher: <?= $row['publisher']; ?></p>
                                <a href="view.php?id=<?= urlencode($row['id']); ?>" class="link link-danger">View</a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p>No results found for <?= $selected_publisher; ?>.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>