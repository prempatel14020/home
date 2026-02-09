<?php

require_once '../private/authentication.php';

// If the user is already logged in, let's kick the out.

if (is_logged_in()) {
   header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   $username = trim($_POST['username']);
   $password = $_POST['password'];

   if (authenticate($username, $password)) {
      header("Location: index.php");
      exit();
   } else {
      $error = "Invalid username or password.";
   }
}

$title = "Login Page";
$introduction = "Please log in using your provided credentials to access your account. If you enter incorrect details, you will receive an error message. Once logged in, you'll be redirected to the admin area.";
include 'includes/header.php';

?>

<?php if (!empty($error))
   echo "<p class=\"text-center text-danger\">$error</p>"; ?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
   class="border border-secondary-subtle shadow-sm rounded m-3 p-3">
   <h2 class="fw-light mb-3">Login Form</h2>

   <!-- Username -->
   <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" id="username" name="username" class="form-control" required>
   </div>

   <!-- Password -->
   <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" name="password" class="form-control" required>
   </div>

   <!-- Submit -->
   <input type="submit" id="submit" name="submit" value="Log In" class="btn btn-primary my-3">
</form>

<?php include 'includes/footer.php'; ?>