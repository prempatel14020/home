<?php

$title = "Search Results: The Comic Chronicler";
include('includes/header.php');
include 'includes/functions.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$search_by = isset($_GET['search_by']) ? $_GET['search_by'] : 'title';
$publishers = isset($_GET['publishers']) ? $_GET['publishers'] : [];
$year_from = isset($_GET['year_from']) ? $_GET['year_from'] : '';
$year_to = isset($_GET['year_to']) ? $_GET['year_to'] : '';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';
$results = [];

$query = "SELECT * FROM lab05_comic_books WHERE 1=1";
$params = [];
$types = '';


if (!empty($keyword)) {
    $query .= " AND $search_by LIKE ?";
    $params[] = '%' . $keyword . '%';
    $types .= 's';
}

// Add publisher filter
if (!empty($publishers)) {
    $placeholders = implode(',', array_fill(0, count($publishers), '?'));
    $query .= " AND publisher IN ($placeholders)";
    foreach ($publishers as $publisher) {
        $params[] = $publisher;
        $types .= 's';
    }
}

// Add year range filter
if (!empty($year_from) && !empty($year_to)) {
    $query .= " AND year BETWEEN ? AND ?";
    $params[] = (int) $year_from;
    $params[] = (int) $year_to;
    $types .= 'ii';
}

if (!empty($sort_order)) {
    $query .= " ORDER BY $search_by $sort_order";
}

$stmt = $connection->prepare($query);
if ($params) {
    $bind_names = [];
    $bind_names[] = $types;
    foreach ($params as $key => $value) {
        $bind_names[] = &$params[$key];
    }
    call_user_func_array([$stmt, 'bind_param'], $bind_names);
}
$stmt->execute();
$results = $stmt->get_result();

?>

<main class="container">
    <section class="row justify-content-center mb-5">
        <div class="col col-md-10 col-xl-8">
            <?php if ($results->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Artist</th>
                            <th>Genre</th>
                            <th>Publisher</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $results->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['title']; ?></td>
                                <td><?= $row['writer']; ?></td>
                                <td><?= $row['artist']; ?></td>
                                <td><?= $row['genre']; ?></td>
                                <td><?= $row['publisher']; ?></td>
                                <td><?= $row['year']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No results found for your search criteria.</p>
            <?php endif; ?>
            <a href="search.php" class="btn btn-danger">Back to Advance Search</a>
        </div>
    </section>
</main>


<?php

include('includes/footer.php');

?>