<?php

/*
    There are a couple of ways that developers might check to see whether or not a user has submitted a form.

    Has the user hit the submit button? == isset($_POST['submit'])
    Has the user filled out the data we need? == isset($_POST['input-1'])
    Is there a POST request? == ($_SERVER['REQUEST_METHOD'] == 'POST')
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number_set = array();

    // This is a special way of handling arrays in PHP. Instead of overwriting the values every time it loops through, it tacks the value onto the end of the array and keeps going.
    for ($i = 1; $i <= $set_length; $i++) {
        // Double quotes need to be used for the key. T_T
        $number_set[] = $_POST["grade-{$i}"];
        $weight_set[] = $_POST["weight-{$i}"];

    }

    /* Assignment Average */

    // sort(): This method sorts an array of numbers in ascending order.
    sort($number_set);

    // count(): This method counts the number of items in an array.
    $grade_count = count($number_set);

    // array_sum(): This method calculates the sum of all items in an array.
    $grade_sum = array_sum($number_set);

    // This is the equation for calculating a numerical average.
    $average = $grade_sum / $grade_count;

    $sum_weight = array_sum($weight_set);

    sort($number_set);

    if ($desired_set_length != '') {
        $weight_count = ($desired_set_length - ((100 - $sum_weight) * $average)) / (100 - $desired_set_length);
    }


    echo '<div class="alert alert-info" role="alert">';
    // echo '<p>Your numbers: ' . implode(', ', $number_set) . '</p>';
    echo "<p><strong>You'r current average is </strong>: {$average}</p>";

    if ($desired_set_length != '') {
        echo "<p><strong>You'r desired average that was entered is </strong>: {$desired_set_length}</p>";
        echo "<p> <strong> The grade that you will need to achieve your desired grade is </strong> : {$weight_count}";
    }
    echo '</div>';
}

?>