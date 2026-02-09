<?php

$title = "Advanced Search: The Comic Chronicler";
include('includes/header.php');
include 'includes/functions.php';


$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$search_by = isset($_GET['search_by']) ? $_GET['search_by'] : 'title';
$publishers = isset($_GET['publishers']) ? $_GET['publishers'] : [];
$year_from = isset($_GET['year_from']) ? $_GET['year_from'] : '';
$year_to = isset($_GET['year_to']) ? $_GET['year_to'] : '';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';
$results = [];


$available_publishers = ['DC Comics', 'Marvel Comics'];


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit'])) {

    $query = "SELECT * FROM lab05_comic_books WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($keyword)) {
        $query .= " AND $search_by LIKE ?";
        $params[] = '%' . $keyword . '%';
        $types .= 's';
    }

    if (!empty($publishers)) {
        $placeholders = implode(',', array_fill(0, count($publishers), '?'));
        $query .= " AND publisher IN ($placeholders)";
        foreach ($publishers as $publisher) {
            $params[] = $publisher;
            $types .= 's';
        }
    }

    if (!empty($year_from) && !empty($year_to)) {
        $query .= " AND year BETWEEN ? AND ?";
        $params[] = (int) $year_from;
        $params[] = (int) $year_to;
        $types .= 'ii';
    }

    $query .= " ORDER BY $search_by $sort_order";

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
}

?>

<main class="container">
    <section class="row justify-content-center mb-5">
        <div class="col col-md-10 col-xl-8">
            <h2 class="display-5 mb-5">Advanced Search</h2>
            <form method="GET" action="search-results.php" class="mb-5 border border-danger p-3 rounded shadow-sm">
                <div class="mb-3">
                    <label for="keyword" class="form-label  h4 fw-light">Search for keywords:</label>
                    <input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo $keyword; ?>">
                </div>

                <div class="mb-3">
                    <label for="search_by" class="form-label  h4 fw-light">Search by:</label>
                    <select class="form-select" id="search_by" name="search_by">
                        <option value="title" <?php echo $search_by === 'title' ? 'selected' : ''; ?>>Title</option>
                        <option value="writer" <?php echo $search_by === 'writer' ? 'selected' : ''; ?>>Writer</option>
                        <option value="artist" <?php echo $search_by === 'artist' ? 'selected' : ''; ?>>Artist</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label  h4 fw-light">Filter by Publisher:</label><br>
                    <?php foreach ($available_publishers as $publisher): ?>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="publisher-<?php echo $publisher; ?>"
                                name="publishers[]" value="<?php echo $publisher; ?>" <?php echo in_array($publisher, $publishers) ? 'checked' : ''; ?>>
                            <label class="form-check-label"
                                for="publisher-<?php echo $publisher; ?>"><?php echo $publisher; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label h4 fw-light">Year of Publication:</label>
                    <div class="d-flex gap-2">
                        <div class="mb-3 d-flex gap-2 align-items-center">
                            <label for="year_from" class="form-label w-100">Year From:</label>
                            <input type="number" class="form-control" id="year_from" name="year_from"
                                value="<?php echo $year_from; ?>" min="1900" max="<?php echo date('Y'); ?>">
                        </div>
                        <div class="mb-3 d-flex gap-2 align-items-center">
                            <label for="year_to" class="form-label w-100">Year To:</label>
                            <input type="number" class="form-control" id="year_to" name="year_to"
                                value="<?php echo $year_to; ?>" min="1900" max="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label  h4 fw-light">Sort Order:</label>

                    <div class="form-check">
                        <input type="radio" id="sort_asc" name="sort_order" value="ASC" <?php echo $sort_order === 'ASC' ? 'selected' : ''; ?> class="form-check-input">
                        <label for="sort_asc" class="form-check-label">Ascending</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="sort_asc" name="sort_order" value="DESC" <?php echo $sort_order === 'DESC' ? 'selected' : ''; ?> class="form-check-input">
                        <label for="sort_asc" class="form-check-label">Descending</label>
                    </div>
                </div>


                <button type="submit" name="submit" class="btn btn-danger">Search</button>
            </form>
</main>


<?php

include('includes/footer.php');

?>