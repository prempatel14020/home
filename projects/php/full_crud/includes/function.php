<?php


function execute_prepared_statement($query, $params = [], $types = "")
{
    global $connection;

    // Let's start by preparing our connection and making sure we're properly ooked up to the database. 
    $statement = $connection->prepare($query);

    // If our preparations fail, we need to handle the error and quit this function. 
    if (!$statement) {
        die("Preparation failed: " . $connection->error);
    }

    // If we need to bind any parameters (i.e. if we're adding, editing, or deleting), we'll do so here. 
    if (!empty($params)) {
        $statement->bind_param($types, ...$params);
    }

    // This executes the statement right from within our IF condition, which makes our code a little more compact.
    if (!$statement->execute()) {
        die("Execution failed: " . $statement->error);
    }

    // If we're doing a SELECT query, we should return the results so that we can print them our for the user. 
    if (str_starts_with(strtolower($query), "select")) {
        return $statement->get_result();
    }

    return true;
}

function count_records()
{
    global $connection;
    $sql = "SELECT COUNT(*) FROM anime_characters;";
    $result = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_row($result);
    return $fetch[0];
}
function search_result_count($keyword)
{
    global $connection;
    $keyword = $connection->real_escape_string($keyword);
    $keyword = '%' . $keyword . '%';

    $sql = "SELECT COUNT(*) FROM anime_characters WHERE 
        character_name LIKE '$keyword' OR 
        anime LIKE '$keyword' OR 
        description LIKE '$keyword' OR 
        personality_type LIKE '$keyword' OR 
        genre LIKE '$keyword' OR 
        genre_2 LIKE '$keyword' OR 
        voice_actor LIKE '$keyword';";

    $result = mysqli_query($connection, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    $fetch = mysqli_fetch_row($result);
    return $fetch[0];
}

function select_row_by_id($id)
{
    $query = "SELECT * FROM anime_characters WHERE id = ?;";
    $result = execute_prepared_statement($query, [$id], "i");

    return $result->fetch_assoc();
}

function validate_user_input($name, $anime, $total_episodes, $description, $personality_type, $genre, $genre_2, $year_of_release, $voice_actor, $popularity_rating)
{

    global $connection;
    $errors = [];
    $validated_data = [];
    $is_valid = true;

    if (empty($name)) {
        $errors[] = "Character name is required.";
        $is_valid = false;
    }
    $validated_data['name'] = $name;
    if (empty($anime)) {
        $errors[] = "Anime name is required.";
        $is_valid = false;
    }
    $validated_data['anime'] = $anime;

    if (!is_numeric($total_episodes) || $total_episodes < 0) {
        $errors[] = "Total episodes must be a non-negative number.";
        $is_valid = false;
    }
    $validated_data['total_episodes'] = $total_episodes;

    if (empty($description)) {
        $errors[] = "Description is required.";
        $is_valid = false;
    }
    $validated_data['description'] = $description;

    if (empty($personality_type)) {
        $errors[] = "Personality type is required.";
        $is_valid = false;
    }
    $validated_data['personality_type'] = $personality_type;

    if (empty($genre)) {
        $errors[] = "Genre is required.";
        $is_valid = false;
    }
    if (
        !in_array($genre, [
            'Shonen',
            'Shojo',
            'Seinen',
            'Josei',
            'Isekai',
            'Slice of Life',
            'Fantasy',
            'Adventure',
            'Romance',
            'Horror'
        ], true)
    ) {
        $errors[] = "Genre must be a valid one.";
        $is_valid = false;

    }
    $validated_data['genre'] = $genre;

    if (empty($genre_2)) {
        $errors[] = "Genre 2 is required.";
        $is_valid = false;
    }
    if (
        !in_array($genre_2, [
            'Shonen',
            'Shojo',
            'Seinen',
            'Josei',
            'Isekai',
            'Slice of Life',
            'Fantasy',
            'Adventure',
            'Romance',
            'Horror'
        ], true)
    ) {
        $errors[] = "Genre 2 must be a valid one.";
        $is_valid = false;

    }
    if ($genre == $genre_2) {
        $errors[] = "Genre's must different from eachother and a valid one.";
        $is_valid = false;

    }
    $validated_data['genre_2'] = $genre_2;

    if (!is_numeric($year_of_release) || $year_of_release < 1900 || $year_of_release > date('Y')) {
        $errors[] = "Year of release must be a valid year.";
        $is_valid = false;
    }
    $validated_data['year_of_release'] = $year_of_release;

    if (empty($voice_actor)) {
        $errors[] = "Voice actor is required.";
        $is_valid = false;
    }
    $validated_data['voice_actor'] = $voice_actor;

    if (!is_numeric($popularity_rating) || $popularity_rating < 0 || $popularity_rating > 10) {
        $errors[] = "Popularity rating must be a number between 0 and 10.";
        $is_valid = false;
    }
    $validated_data['popularity_rating'] = $popularity_rating;

    return [
        'is_valid' => empty($errors),
        'errors' => $errors,
        'data' => $validated_data
    ];

}
function update_record($name, $anime, $total_episodes, $description, $personality_type, $genre, $genre_2, $year_of_release, $voice_actor, $popularity_rating, $id)
{
    $query = "UPDATE anime_characters SET character_name = ?, anime = ?, total_episodes = ?, description = ?, personality_type = ?, genre = ?, genre_2 = ?, year_of_release = ?, voice_actor = ?, popularity_rating = ?,  date_edited = NOW() WHERE id = ?;";
    return execute_prepared_statement($query, [$name, $anime, $total_episodes, $description, $personality_type, $genre, $genre_2, $year_of_release, $voice_actor, $popularity_rating, $id], "ssissssissi");
}
function delete_record($id)
{
    $query = "DELETE FROM anime_characters WHERE id = ?;";
    return execute_prepared_statement($query, [$id], "i");
}
?>