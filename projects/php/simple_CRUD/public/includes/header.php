<?php

// First, we need to establish a connection to the database.
require_once('/home/ppatel133/data/connect.php');
$connection = db_connect();

require('../private/prepared.php');
require('../private/functions.php');
include('../private/variables.php');

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title; ?> | Movies Online Database</title>

  <!-- BS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column justify-content-between">
  <header class="text-center p-3">
    <nav>
      <a href="index.php" class="btn btn-dark">Home</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="add.php" class="btn btn-success">Add</a>
        <a href="edit.php" class="btn btn-warning">Edit</a>
        <a href="delete.php" class="btn btn-danger">Delete</a>
        <a href="logout.php" class="btn btn-outline-secondary">Log Out</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-success">Log In</a>
      <?php endif ?>

    </nav>
  </header>
  <main class="p-5">
    <!-- Introduction -->
    <section class="container m-auto row justify-content-center text-center">
      <div class="col col-md-10 col-xl-8">
        <h1 class="fw-light"><?php echo $title; ?></h1>
        <p class="lead text-muter mb-5"><?php echo $introduction; ?></p>
      </div> <!-- end of introduction -->
    </section>

    <!-- Page Content -->
    <section>
      <div>