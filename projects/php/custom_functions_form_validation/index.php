<?php
require 'public/validation/custom-validation.php';

require 'public/validation/validation.php';
include 'public/backend/header.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $recipient_Name = $_POST['recipient-name'] ?? '';
  $your_Name = $_POST['your-name'] ?? '';
  $recipient_phone = $_POST['phone-number'] ?? '';
  $phone = $_POST['your-phone'] ?? '';


  // Validate recipient name
  if (!validate_name($recipient_Name)) {
    $validation_errors['recipient-name'][] = "Please enter a valid First and Last name for the recipient.";
  }
  if (!validate_name($your_Name)) {
    $validation_errors['your-name'][] = "Please enter your valid First and Last name.";
  }
  if (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
    $validation_errors['your-phone'][] = "<p>Please enter a valid phone number, using numbers only.</p>";

  }

  if (!has_valid_phone_format($recipient_phone)) {
    $validation_errors['phone-number'][] = "<p>Please enter a valid recipient phone number, using the correct pattern i.e 123-456-7890 $recipient_phone </p>";
  }

  if (!has_valid_phone_format($phone)) {
    $validation_errors['your-phone'][] = "<p>Please enter your valid phone number, using the correct pattern i.e 123-456-7890</p>";
  }




  $current_time_stamp = time();

  // Calculate the timestamp for 3 days from the current date
  // formula current date + 2 days * 1 day worth of time
  $min_time_stamp = $current_time_stamp + (2 * 24 * 60 * 60); // 3 days in seconds

  // Get the submitted delivery date
  $submitted_date = $_POST['delivery-date'];

  // Convert the submitted date to a timestamp
  $submitted_time_stamp = strtotime($submitted_date);


  // Check if the submitted date is less than the minimum date
  if ($submitted_time_stamp < $min_time_stamp) {
    $validation_errors['delivery-date'][] = "The chosen date of delivery i.e. $submitted_date is not valid. (cannot be less than 3 days from today). Please select a valid date.";
  }
  if (count($validation_errors) == 0) {
    header("location:thank-you.php");
  }
}
?>


<main>
  <!-- Introduction -->
  <section class="intro py-5 mb-5">
    <div class="container text-white py-5">
      <div class="col-xl-6">
        <h2 class="display-3">Say it with flowers.</h2>
        <p>At Petal & Stem, we believe that flowers are more than just pretty petals - they're a powerful way to
          express
          your emotions and connect with the people you love. Whether you're celebrating a special occasion,
          expressing
          gratitude, or simply want to brighten someone's day, our beautiful floral arrangements and bouquets are
          the
          perfect way to say what's on your mind and in your heart.</p>
      </div>
    </div>
  </section>
  <!-- Form -->
  <section class="container">
    <div class="row justify-content-center">
      <?php
      if ($validation_errors) {
        echo "<div class=\"alert alert-danger mb-4 col-lg-8 border border-success p-4 mb-2 border-opacity-25 rounded \" >";
        echo "<p>There were <strong>validation errors</strong> in your submission: </p>";
        echo "<ul>";
        foreach ($validation_errors as $field => $message) {
          foreach ($message as $warning) {
            echo "<li>$warning</li>";
          }
        }
        echo "</ul>";
        echo "</div>";
      }
      ?>
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
        class="col-lg-8 border border-success p-4 mb-2 border-opacity-25 rounded">
        <h2>Request a Quote for a Custom Flower Arrangement</h2>
        <p>Let us create a beautiful, custom flower arrangement for your special occasion. Simply fill out the form
          below and we'll get started on a quote for a unique flower arrangement, tailored to your preferences.</p>

        <!-- Receivers Information -->
        <fieldset class="mb-4">
          <legend class="fw-medium mb-3">About the Recipient</legend>
          <div class="mb-3">
            <label for="recipient-name" class="form-label fw-medium">Recipient's Name:</label>
            <input type="text" name="recipient-name" id="recipient-name" class="form-control"
              value="<?= htmlspecialchars($data['recipient-name'] ?? '') ?>">
            <p class="text-muted" id="recipient-name-help">The recipients First and Last name.</p>
          </div>
          <div class="mb-3">
            <label for="phone-number" class="form-label fw-medium">Recipient's Phone Number:</label>
            <input type="text" name="phone-number" id="phone-number" class="form-control"
              value="<?= htmlspecialchars($data['phone-number'] ?? '') ?>">
            <p class="text-muted" id="phone-number-help">We need to be able to contact them in case there are any issues
              with the delivery.</p>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label fw-medium">Card Message (Optional):</label>
            <textarea name="message" id="message" class="form-control"
              rows="4"> <?= htmlspecialchars($data['message'] ?? '') ?></textarea>
            <p class="text-muted" id="message-help">We can fit maximum of 255 characters on our cards.</p>
          </div>
          <div class="mb-3">
            <label for="delivery-date" class="form-label fw-medium">Delivery Date:</label>
            <input type="date" name="delivery-date" id="delivery-date" class="form-control"
              value="<?= htmlspecialchars($data['delivery-date'] ?? '') ?>">
            <p class="text-muted" id="delivery-date-help">We require a minimum of 72 hours lead-time for custom orders.
              We deliver from 10AM to 6PM daily.</p>
          </div>
        </fieldset>


        <!-- Arrangement Details -->
        <fieldset class="mb-4">
          <legend class="fw-medium mb-3">Your Arrangement</legend>

          <div class="mb-3">
            <label for="occasion" class="form-label fw-medium">Occasion:</label>
            <select name="occasion" id="occasion" class="form-select">
              <option value="">Select an occasion</option>
              <option value="birthdays" <?= (isset($data['occasion']) && $data['occasion'] === 'birthdays') ? 'selected' : '' ?>>Birthday's</option>
              <option value="sympathy_and_funeral" <?= (isset($data['occasion']) && $data['occasion'] === 'sympathy_and_funeral') ? 'selected' : '' ?>>Sympathy and Funeral</option>
              <option value="anniversary" <?= (isset($data['occasion']) && $data['occasion'] === 'anniversary') ? 'selected' : '' ?>>Anniversary</option>
              <option value="mother_day" <?= (isset($data['occasion']) && $data['occasion'] === 'mother_day') ? 'selected' : '' ?>>Mother's Day</option>
              <option value="just_because" <?= (isset($data['occasion']) && $data['occasion'] === 'just_because') ? 'selected' : '' ?>>Just Because</option>
              <option value="thank_you" <?= (isset($data['occasion']) && $data['occasion'] === 'thank_you') ? 'selected' : '' ?>>Thank You</option>
              <option value="new_baby" <?= (isset($data['occasion']) && $data['occasion'] === 'new_baby') ? 'selected' : '' ?>>New Baby</option>
              <option value="housewarming" <?= (isset($data['occasion']) && $data['occasion'] === 'housewarming') ? 'selected' : '' ?>>Housewarming</option>
            </select>
            <p class="text-muted" id="occasion-help">We'll select the right color and flowers for the occasion.</p>
          </div>

          <!-- Size Selection -->
          <div class="mb-3">
            <legend class="form-label fw-medium fs-6">Size:</legend>
            <div class="form-check">
              <input type="radio" name="size" id="regular" value="regular" class="form-check-input"
                <?= (isset($data['size']) && $data['size'] === 'regular') ? 'checked' : '' ?>>
              <label for="regular" class="form-check-label">Regular Bouquet</label>
            </div>

            <div class="form-check">
              <input type="radio" name="size" id="premium" value="premium" class="form-check-input"
                <?= (isset($data['size']) && $data['size'] === 'premium') ? 'checked' : '' ?>>
              <label for="premium" class="form-check-label">Premium Bouquet <span
                  class="text-secondary">(+$9.99)</span></label>
            </div>

            <div class="form-check">
              <input type="radio" name="size" id="deluxe" value="deluxe" class="form-check-input"
                <?= (isset($data['size']) && $data['size'] === 'deluxe') ? 'checked' : '' ?>>
              <label for="deluxe" class="form-check-label">Deluxe Bouquet <span
                  class="text-secondary">(+$12.99)</span></label>
            </div>

            <div class="form-check">
              <input type="radio" name="size" id="centerpiece" value="centerpiece" class="form-check-input"
                <?= (isset($data['size']) && $data['size'] === 'centerpiece') ? 'checked' : '' ?>>
              <label for="centerpiece" class="form-check-label">Centerpiece <span
                  class="text-secondary">(+$24.99)</span></label>
            </div>
          </div>


          <!-- Add-Ons -->
          <div class="mb-3">
            <legend class="form-label fw-medium fs-6">Add-Ons (Optional) :</legend>
            <div class="form-check">
              <input type="checkbox" name="add_ons[]" id="chocolate" value="chocolate" class="form-check-input"
                <?= (isset($data['add_ons']) && in_array('chocolate', $data['add_ons'])) ? 'checked' : '' ?>>
              <label for="chocolate" class="form-check-label">Milk Chocolate <span
                  class="text-secondary">(+$9.99)</span></label>
            </div>
            <div class="form-check">
              <input type="checkbox" name="add_ons[]" id="shortbread" value="shortbread" class="form-check-input"
                <?= (isset($data['add_ons']) && in_array('shortbread', $data['add_ons'])) ? 'checked' : '' ?>>
              <label for="shortbread" class="form-check-label">Shortbread <span
                  class="text-secondary">(+$9.99)</span></label>
            </div>
            <div class="form-check">
              <input type="checkbox" name="add_ons[]" id="belgium-truffles" value="belgium-truffles"
                class="form-check-input" <?= (isset($data['add_ons']) && in_array('belgium-truffles', $data['add_ons'])) ? 'checked' : '' ?>>
              <label for="belgium-truffles" class="form-check-label">Belgium Truffles <span
                  class="text-secondary">(+$12.99)</span></label>
            </div>
            <div class="form-check">
              <input type="checkbox" name="add_ons[]" id="wine" value="wine" class="form-check-input"
                <?= (isset($data['add_ons']) && in_array('wine', $data['add_ons'])) ? 'checked' : '' ?>>
              <label for="wine" class="form-check-label">Red Wine <span class="text-secondary">(+$19.99)</span></label>
            </div>
            <div class="form-check">
              <input type="checkbox" name="add_ons[]" id="teddy" value="teddy" class="form-check-input"
                <?= (isset($data['add_ons']) && in_array('teddy', $data['add_ons'])) ? 'checked' : '' ?>>
              <label for="teddy" class="form-check-label">Large Teddy Bear<span
                  class="text-secondary">(+$24.99)</span></label>
            </div>
          </div>

          <!-- Presentation Options -->
          <div class="mb-3">
            <legend class="form-label fw-medium fs-6">Presentation Options:</legend>
            <div class="form-check">
              <input type="radio" name="presentation" id="rustic" value="rustic" class="form-check-input"
                <?= (isset($data['presentation']) && $data['presentation'] === 'rustic') ? 'checked' : '' ?>>
              <label for="rustic" class="form-check-label">Rustic Wrapping <span
                  class="text-secondary">(+$4.99)</span></label>
            </div>
            <div class="form-check">
              <input type="radio" name="presentation" id="small-vase" value="small-vase" class="form-check-input"
                <?= (isset($data['presentation']) && $data['presentation'] === 'small-vase') ? 'checked' : '' ?>>
              <label for="small-vase" class="form-check-label">Small Vase (Round) <span
                  class="text-secondary">(+$9.99)</span></label>
            </div>
            <div class="form-check">
              <input type="radio" name="presentation" id="large-vase" value="large-vase" class="form-check-input"
                <?= (isset($data['presentation']) && $data['presentation'] === 'large-vase') ? 'checked' : '' ?>>
              <label for="large-vase" class="form-check-label">Large Vase (Flared, Tall)<span
                  class="text-secondary">(+$14.99)</span></label>
            </div>
          </div>
        </fieldset>


        <!-- Your Information -->
        <fieldset class="mb-4">
          <legend class="fw-medium mb-3">Your Information</legend>
          <div class="mb-3">
            <label for="your-name" class="form-label fw-medium">Your Name:</label>
            <input type="text" name="your-name" id="your-name" class="form-control"
              value="<?= htmlspecialchars($data['your-name'] ?? '') ?>">
            <p class="text-muted" id="your-name-help">You'r first and last name.</p>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-medium">Email Address:</label>
            <input type="text" name="email" id="email" class="form-control"
              value="<?= htmlspecialchars($data['email'] ?? '') ?>">
            <p class="text-muted" id="email-help">We will exclusively use your email to contact you about your custom
              arrangement quote.</p>
          </div>
          <div class="mb-3">
            <label for="your-phone" class="form-label fw-medium">Phone Number:</label>
            <input type="text" name="your-phone" id="your-phone" class="form-control"
              value="<?= htmlspecialchars($data['your-phone'] ?? '') ?>">
            <p class="text-muted" id="your-phone-help">Your phone number, in the following format: 123-456-7890</p>
          </div>
        </fieldset>

        <div class="mb-3 mt-4">
          <input type="submit" name="submit" class="btn btn-success" value="Get Quote">
        </div>
      </form>
    </div>
  </section>

</main>

<?php include 'public/backend/footer.php' ?>