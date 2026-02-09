<?php


/* RESULTS TABLE */

/**
 * This function fetches all of the rows in our database and prints them out in an HTML table.
 * @param callable|null $button_callback - A callback function that generates the 'actions' column content.
 * @return void (because this function prints a table and handles potential errors on its own)
 */
function generate_table($button_callback = null)
{

    // Let's start by calling the function to retrieve all rows.
    $rows = get_all_rows();

    if (count($rows) > 0) {
        echo "<table class=\"table table-bordered table-hover mw-100\"> \n
            <thead> \n
             <tr> \n
             <th scope=\"col\">Title</th> \n
             <th scope=\"col\">Media Type</th> \n
             <th scope=\"col\">Release Year</th> \n
             <th scope=\"col\">Genre 1</th> \n
             <th scope=\"col\">Genre 2</th> \n
             <th scope=\"col\">Starring</th> \n
             <th scope=\"col\">Summary</th> \n
             <th scope=\"col\">Watched</th> \n
             <th scope=\"col\">Personal Rating</th> \n
             <th scope=\"col\">Streaming Url</th> \n

             ";
        if ($button_callback !== null) {
            echo "<th scope=\"col\">Actions</th> \n";
        }
        echo "</tr> \n
            </thead> \n
            <tbody> \n";

        foreach ($rows as $row) {
            extract($row);
            echo "<tr> \n
                  <td>$title</td> \n
                  <td>$media_type</td> \n
                  <td>$release_year</td> \n
                  <td>$genre1</td> \n
                  <td>$genre2</td> \n
                  <td>$starring</td> \n
                  <td>$summary</td> \n
                  <td>$watched</td> \n
                  <td>$personal_rating</td> \n
                  <td class=' text-wrap text-truncate'><a href=\"$streaming_url\" class=\"link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover\">$streaming_url</a></td> \n";

            if ($button_callback !== null) {
                // Generate buttons dynamically using the callback
                $buttons = call_user_func($button_callback, $row);
                echo "<td>$buttons</td> \n";
            }

            echo "</tr> \n";
        }

        echo "</tbody> \n </table>";
    } else {
        echo "<h2 class=\"fw-light\">Oh no!</h2>";
        echo "<p>We're sorry, but we weren't able to find anything.</p>";
    }
}


/* DATA VALIDATION */

/**
 * This will validate our user input on the add and edit pages of our application.
@param string $title
 * @param string $media_type
 * @param int $release_year
 * @param string  $genre1
 * @param string $genre2
 * @param string $starring
 * @param string $summary
 * @param int $watched
 * @param int$personal_rating
 * @param string $streaming_url
 * @return array
 */
function validate_record_input($title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url)
{
    global $connection;

    $errors = [];
    $validated_data = [];

    // Validate city name
    $title = trim($title);
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    $validated_data['title'] = $title;
    // validate media type
    $media_type = trim($media_type);
    if (empty($media_type)) {
        $errors[] = "Media Type is required.";
    }
    $validated_data['media_type'] = $media_type;

    // validate release year
    $release_year = filter_var(trim($release_year), FILTER_SANITIZE_NUMBER_INT);
    if (empty($release_year) || !is_numeric($release_year) || $release_year < 1900 || $release_year > date("Y")) {
        $errors[] = "Valid Release year is required.";
    }
    $validated_data['release_year'] = $release_year;
    // Validate genres
    $genre1 = trim($genre1);
    if (empty($genre1) || is_numeric($genre1)) {
        $errors[] = "At least one genre is required.";
    }
    $validated_data['genre1'] = $genre1;

    $genre2 = trim($genre2);
    if (is_numeric($genre2)) {
        $errors[] = "Enter a valid genre for genre 2.";
    }
    $validated_data['genre2'] = $genre2;

    // Validate starring
    $starring = trim($starring) || is_numeric($genre1);
    if (empty($starring)) {
        $errors[] = "Starring information is required.";
    }
    $validated_data['starring'] = $starring;

    // Validate summary
    $summary = trim($summary);
    if (empty($summary)) {
        $errors[] = "Summary is required.";
    }
    $validated_data['summary'] = $summary;

    // Validate watched status
    $watched = trim($watched);
    if (!in_array($watched, ['0', '1'], true) || !is_numeric($watched)) {
        $errors[] = "Watched status must be '0' or '1'.";
    }
    $validated_data['watched'] = $watched;

    // Validate personal rating
    if ($personal_rating === '') {
        $validated_data['personal_rating'] = null;
    } elseif (!is_numeric($personal_rating) || $personal_rating > 5) {
        $errors[] = "Personal rating must be a number equal or less than 5 or null if you haven't watched the entry yet.";
    } else {
        $validated_data['personal_rating'] = $personal_rating;
    }

    // Validate streaming URL
    $streaming_url = trim($streaming_url);
    if (!empty($streaming_url) && !filter_var($streaming_url, FILTER_VALIDATE_URL)) {
        $errors[] = "Streaming URL must be a valid URL.";
    }
    $validated_data['streaming_url'] = $streaming_url;


    // A function can only return one value, so we're packing a few different things into an array.
    return [
        'is_valid' => empty($errors),
        'errors' => $errors,
        'data' => $validated_data
    ];
}

?>