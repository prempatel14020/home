<?php

/**
 * SESSION START & CONNECTION HANDLE
 */

session_set_cookie_params([
  'lifetime' => 0,//session will expire on browser close
  'path' => '/',
  'domain' => '',
  'secure' => TRUE, //The browsershould only send data over HTTPS.
  'httponly' => TRUE, // this prevents javascript from setting the COOKIE.
  'samesite' => 'strict'//this preents cross-site request forery (CSRF) attack.
]);


session_start();

require_once('/home/ppatel133/data/connect.php');
$connection = db_connect();

/**
 * Authenticate user based on username and password.
 */
function authenticate($username, $password)
{
  global $connection;

  $statement = $connection->prepare("SELECT account_id, hashed_pass FROM catalogue_admin WHERE username = ?");
  if (!$statement) {
    die("Prepare failed: " . $connection->error);
  }

  $statement->bind_param("s", $username);
  $statement->execute();

  $statement->store_result();
  if ($statement->num_rows > 0) {
    $statement->bind_result($account_id, $hashed_pass);
    $statement->fetch();

    if (password_verify($password, $hashed_pass)) {
      // To prevent session hijacking attacks, we can reset the session ID and data. 
      session_regenerate_id(true);

      $_SESSION['user_id'] = $account_id;
      $_SESSION['username'] = $username;
      $_SESSION['last_regeneration'] = time();

      return true;
    }
  }

  return false;
}

/**
 * Checks if a user is currently logged in.
 */

function is_logged_in()
{
  return isset($_SESSION['user_id']);
}

/**
 * Redirects a user if they are not logged in.
 */
function require_login()
{
  if (!is_logged_in()) {
    header("Location: login.php");
    exit();
  }
}

/**
 * Logs the user out.
 */
function logout()
{
  // Removes all the variables we assigned from the $_SESSION.
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}

/**
 *Peridicoally 
 */
function enforce_session_security()
{
  if (isset($_SESSION['last_regeneration'])) {
    if (time() - $_SESSION['last_regeneration'] > 300) {
      session_regenerate_id(true);
      $_SESSION['last_regeneration'] = time();
    }
  }
}
?>