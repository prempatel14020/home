<?php

/*
    This script will use prepared statements, which adds a layer of abstraction between our user's (potentially dangerous) input and the SQL statements we're executing. 

    Just like programatic MySQLi, using prepared statements means we need to follow a certain series of steps. 

    1. Make sure we're connected to the database. 

    2. Write the SQL query with placeholders (?) for each parameter.

    3. Prepare the query using $connection->prepare(@query); while handling any errors if it fails.

    4. Bind the input values to the placeholders in the query using $statement->bind_param(); method and passing in all of the required variables/values. 

    5. Call $statement->execute() to actually execute the prepared statement. 

    6. For SELECT queries, retrieve the result using $statement->get_result();

    7. Close the connection handle to free up server resources.
*/

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

/**
 * SELECT: This function selects all of the data in our prem_attractions table.
 * @return array
 */
function get_all_rows()
{
    $query = "SELECT * FROM prem_attractions;";
    $result = execute_prepared_statement($query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * SELECT: This function retrieves a single record from our table, based upon primary key.
 * @param int $id (This is the primary key of the record we're selecting.)
 * @return array|bool|null
 */
function select_row_by_id($id)
{
    $query = "SELECT * FROM prem_attractions WHERE id = ?;";
    $result = execute_prepared_statement($query, [$id], "i");

    return $result->fetch_assoc();
}

/**
 * INSERT: This function will INSERT (i.e. add or create) a new city in our database. 
 * Note: This is used in the add.php page. 
 */

function insert_record($title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url)
{
    $query = "INSERT INTO prem_attractions (title, media_type, release_year, genre1,genre2,starring,summary,watched,personal_rating,streaming_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    return execute_prepared_statement($query, [$title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url], "ssissssiis");
}

/**
 * UPDATE: Updates an existing record in the database. Used on the edit pages.
 * @param string $title
 * @param string $media_type
 * @param int $release_year
 * @param string  $genre1
 * @param string $genre2
 * @param string $starring
 * @param string $summary
 * @param int $watched
 * @param int$personal_rating
 * @param string $streaming_url
 * @param int $id (Primary Key)
 * @return bool|mysqli_result
 */

function update_record($title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url, $id)
{
    $query = "UPDATE prem_attractions SET title = ?, media_type = ?, release_year = ?, genre1=?, genre2=?, starring=?, summary=?, watched=?, personal_rating=?, streaming_url=?  WHERE id = $id;";
    return execute_prepared_statement($query, [$title, $media_type, $release_year, $genre1, $genre2, $starring, $summary, $watched, $personal_rating, $streaming_url], "ssissssiis");
}

/**
 * DELETE: This function deletes a single record from the database by its primary key.
 * @param int $id
 * @return bool|mysqli_result
 */
function delete_record($id)
{
    $query = "DELETE FROM prem_attractions WHERE id = ?;";
    return execute_prepared_statement($query, [$id], "i");
}

?>