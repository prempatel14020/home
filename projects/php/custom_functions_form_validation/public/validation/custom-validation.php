<?php

function validate_name($name)
{
    $name = trim($name);

    $space_Position = strpos($name, ' ');

    if ($space_Position === false) {
        return false;
    }

    // Split into two parts based on the first space
    $first_Name = substr($name, 0, $space_Position);
    $last_Name = substr($name, $space_Position + 1);

    // Ensure there are both a first and last name
    if ($first_Name && $last_Name) {
        return true;
    }

    // if either is empty then return false
    return false;
}

function has_valid_phone_format($value)
{
    $phone_regex = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';
    return preg_match($phone_regex, $value) === 1;
}
?>