<?php
// Establish a connection to the database
require_once('/home/ppatel133/data/connect.php');

$connection = db_connect();
if (isset($_GET['keyword'])) {
    $keyword = $connection->real_escape_string($_GET['keyword']);
}
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body class="d-flex  min-vh-100 flex-column gap-5 bg-dark text-white p-3">
    <header class="text-center d-flex justify-content-between container p-3">
        <nav>
            <a href="index.php" class="btn btn-info">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="insert.php" class="btn btn-success">Add</a>
                <a href="edit.php" class="btn btn-warning">Edit</a>
                <a href="delete.php" class="btn btn-danger">Delete</a>
                <a href="logout.php" class="btn btn-outline-danger">Log Out</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-success">Log In</a>
            <?php endif ?>
        </nav>
        <div>
            <form method="GET" action="search_results.php" class="d-flex align-items-center gap-2">

                <div class="form-group d-flex align-items-center gap-2">
                    <label for="keyword">Keyword:</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" value="<?php if (isset($_GET['keyword'])) {
                        echo $keyword;
                    } ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

    </header>
    <main>
        <section class="row justify-content-center text-center">
            <div class="col col-md-10 col-xl-8">
                <h1 class="fw-light"><?php echo $title; ?></h1>
                <p class="lead text-muter mb-5"><?php echo $introduction; ?></p>
            </div>
        </section>