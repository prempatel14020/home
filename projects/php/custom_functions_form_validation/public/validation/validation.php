<?php

require '/home/ppatel133/data/valitron/src/Valitron/Validator.php';

use Valitron\Validator;

// This array will hold our validation messages to the user.
$validation_errors = [];

// And this array is to hold our user's input.
$data = [];

$pass_message = "";

// When the user submits something using the POST method, we'll start our validation process.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = $_POST;

    $v = new Validator($data);
    $v->rule('required', ['recipient-name', 'phone-number', 'delivery-date', 'occasion', 'size', 'presentation', 'your-name', 'email', 'your-phone']);
    $v->rule('email', 'email');
    $v->rule('in', 'occasion', ['birthdays', 'sympathy_and_funeral', 'anniversary', 'mother_day', 'just_because', 'thank_you', 'new_baby', 'housewarming']);
    $v->rule('in', 'size', ['regular', 'premium', 'deluxe', 'centerpiece']);

    // We have to do a little more with the checkboxes.
    if (!empty($data['add_ons'])) {
        foreach ($data['add_ons'] as $add_ons) {
            if (!in_array($add_ons, ['chocolate', 'shortbread', 'belgium-truffles', 'wine', 'teddy'])) {
                $v->error('hobbies', 'Please choose one or more Add-ons from the provided list.');
                break;
            }
        }
    }


    $v->rule('in', 'presentation', ['rustic', 'small-vase', 'large-vase']);
    $v->rule('lengthMax', 'message', 255);

    // If the user has errors, let's print them!
    if ($v->validate() && empty($v->errors())) {
        $pass_message = "<p class=\"bg-success mb-4 col-lg-8 border border-success p-4 mb-2 border-opacity-25 rounded text-white fw-medium \">Form submitted successfully!</p>";
    } else {
        $validation_errors = $v->errors();
    }

}
?>