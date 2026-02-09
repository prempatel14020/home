<?php
require_once('data/connect.php');
$connection = db_connect();
/**
 * This counts the number of records we currently have in our table (in case any have been added or removed).
 * @return int number of records in table
 */
function count_records()
{
    global $connection;
    $sql = "SELECT COUNT(*) FROM lab05_comic_books;";
    $result = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_row($result);
    return $fetch[0];
}

/**
 * This function lets us grab only the records that we need for one page of paginated results. 
 * @param int $limit
 * @param int $offset
 * @return bool|mysqli_result
 */

function get_random_comic_title()
{
    global $connection;


    $query = "SELECT id,title,writer,artist FROM lab05_comic_books ORDER BY RAND() LIMIT 1";
    $result = $connection->query($query);

    // Check if a result was returned
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $title = $row['title'];
        $writer = $row['writer'];
        $artist = $row['artist'];

        echo "<div class='text-center p-3 mb-3'>
        <p class='mb-1 p-2'><strong>Title:</strong> $title</p>
        <p class='mb-1 p-2'><strong>Writer:</strong> $writer</p>
        <p class='mb-1 p-2'><strong>Artist:</strong> $artist</p>
        <a href='view.php?id=$id' class='link link-danger p-2'>View</a>
      </div>";
    } else {
        return "No featured title available.";
    }
}

function display_all_comics()
{
    global $connection;


    $limit = 10;


    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page_number = (int) $_GET['page'];
    } else {
        $page_number = 1;
    }

    $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $sort_order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';


    $initial_page = ($page_number - 1) * $limit;


    $query = "SELECT * FROM lab05_comic_books ORDER BY $sort_column $sort_order LIMIT $initial_page, $limit";
    $result = $connection->query($query);


    if ($result->num_rows > 0) {

        echo '<table class="table table-bordered">';
        echo '<thead class="table-dark">';
        echo '<tr>';
        echo '<th><a class="text-light" href="?sort=title&order=' . ($sort_column === 'title' && $sort_order === 'ASC') . '">Title</a></th>';
        echo '<th><a class="text-light" href="?sort=writer&order=' . ($sort_column === 'writer' && $sort_order === 'ASC') . '">Writer</a></th>';
        echo '<th><a class="text-light" href="?sort=artist&order=' . ($sort_column === 'artist' && $sort_order === 'ASC') . '">Artist</a></th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';


        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['writer'] . '</td>';
            echo '<td>' . $row['artist'] . '</td>';
            echo '<td><a href="view.php?id=' . $row['id'] . '" class="link link-danger">View</a></td>';
            echo '</tr>';
        }


        echo '</tbody>';
        echo '</table>';
    } else {

        echo '<p>No comic books found.</p>';
    }
}
?>