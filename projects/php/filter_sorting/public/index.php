<?php

$title = "The Comic Chronicler";
include('includes/header.php');
include('includes/functions.php');
$per_page = $_POST['number-of-results'] ?? $_GET['number-of-results'] ?? 10;

$total_count = count_records();

$total_pages = ceil($total_count / $per_page);

$current_page = (int) ($_GET['page'] ?? 1);

if ($current_page < 1 || $current_page > $total_pages || !is_int($current_page)) {
    $current_page = 1;
}

$offset = $per_page * ($current_page - 1);


?>

<main class="container">
    <section class="row justify-content-between my-5">

        <div class="col-md-10 col-lg-8 col-xxl-6 mb-4">
            <h2 class="display-4">Welcome to <span class="d-block text-danger">The Comic Chronicler</span></h2>
            <p>Discover and explore a vast collection of comic books with The Comic Chronicler. Search, sort, and filter
                through our extensive database of titles, writers, and artists. Find your favorite characters, delve
                into exciting storylines, and uncover hidden gems. Whether you're a seasoned comic book enthusiast or a
                curious newcomer, The Comic Chronicler is your gateway to the thrilling world of comics.</p>
        </div>

        <div
            class="col col-lg-4 col-xxl-3 m-4 m-md-0 mb-md-4 border border-danger rounded p-3 d-flex flex-column justify-content-center align-items-center">
            <h2 class="fw-light mb-3">Featured Title</h2>
            <?php echo "<h3>" . get_random_comic_title() . "</h3>" ?>
        </div>
    </section>


    <section>
        <?php display_all_comics(); ?>
        <nav aria-label="Page Number">
            <ul class="pagination justify-content-center">

                <?php if ($current_page > 1): ?>
                    <li class="page-item">
                        <a href="index.php?page=<?= $current_page - 1; ?>&number-of-results=<?= $per_page; ?>"
                            class="page-link link-danger">Previous</a>
                    </li>
                <?php endif;

                $gap = FALSE;

                $window = 1;

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i > 1 + $window && $i < $total_pages - $window && abs($i - $current_page) > $window) {
                        if (!$gap): ?>

                            <li class="page-item"><span class="page-link link-danger">...</span></li>

                        <?php endif;
                        $gap = TRUE;
                        continue;
                    }

                    $gap = FALSE;

                    if ($current_page == $i): ?>
                        <li class="page-item bg-danger active">
                            <a href="#" class="page-link bg-danger link-white border border-danger"><?= $i; ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a href="index.php?page=<?= $i; ?>&number-of-results=<?= $per_page; ?>"
                                class="page-link link-danger"><?= $i; ?></a>
                        </li>
                    <?php endif;
                }
                ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item">
                        <a href="index.php?page=<?= $current_page + 1; ?>&number-of-results=<?= $per_page; ?>"
                            class="page-link link-danger">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </section>
</main>

<?php

include('includes/footer.php');

?>