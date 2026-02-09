<!doctype html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lab 1: Final Grade Calculator</title>

    <!-- BS Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">
    <section class="row justify-content-center">
        <h1 class="text-center my-5">Final Grade Calculator</h1>

        <!-- Welcome & Definitions -->
        <div class="col-md-6">

            <div class="card">
                <div class="card-header bg-info">
                    <h2 class="card-title">How does this calculator work?</h2>
                </div>
                <div class="card-body">
                    <p class="mb-4 text-body-secondary">First to start with the calculation enter the number of
                        assignments that you have completed/been graded on so far.</p>
                    <p class="mb-4 text-body-secondary">After that, you will need to enter the <strong>Grade</strong>
                        earned on the first
                        input for a assignment and the <strong>Weight</strong> for that assignment on the second input
                        area.
                    </p>

                    <p class="mb-4 text-body-secondary"><strong>[OPTIONAL]</strong> Enter the desired average that you
                        want in <strong>the optional field</strong> and we can help you know the percentage
                        you will need approximately to get that desired grade.</p>
                </div> <!-- end of .card-body -->
            </div> <!-- end of .card -->
        </div>

        <!-- Form -->
        <div class="col-md-6">
            <!-- We need to determine whether or not the user has given us the length of their data set yet. -->
            <?php
            $set_length = '';

            switch (TRUE) {
                case isset($_GET["set-length"]):
                    $set_length = $_GET["set-length"];
                    break;
                case isset($_POST["hidden-set-length"]):
                    $set_length = $_POST["hidden-set-length"];
                    break;
            }
            // $desired_set_length = $_GET["desired-set-length"];
            $desired_set_length = '';
            switch (TRUE) {
                case isset($_GET["desired-set-length"]):
                    $desired_set_length = $_GET["desired-set-length"];
                    break;
                case isset($_POST["desired-set-length"]):
                    $desired_set_length = $_POST["desired-set-length"];
                    break;
            }


            include('process.php');
            ?>

            <!-- This form ask the user, how many numbers they have in their data set so that we can dynamically generate the number of form fields they need. -->
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET" class="mb-5">
                <h2>Let's start with the Final Grade Calculator.</h2>
                <div class="mb-3">
                    <label for="set-length" form="form-label">How many numbers of assignments have you completed so
                        far?</label>
                    <input type="number" id="set-length" name="set-length" value="<?php echo $set_length; ?>"
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label for="desired-set-length" form="form-label"><strong>[ OPTIONAL ] </strong>What is you'r
                        desired
                        grade:</label>
                    <input type="number" id="desired-set-length" name="desired-set-length"
                        value="<?php echo $desired_set_length; ?>" class="form-control">
                </div>

                <input type="submit" id="submit-get" name="submit-get" value="Generate Form" class="btn btn-info">
            </form>

            <?php if ($set_length != ''): ?>

                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                    <input type="hidden" name="hidden-set-length" id="hidden-set-length" value="<?php echo $set_length; ?>">
                    <input type="hidden" name="hidden-desired-set-length" id="hidden-desired-set-length"
                        value="<?php echo $desired_set_length; ?>">
                    <?php
                    for ($i = 1; $i <= $set_length; $i++) {

                        // if (isset($_POST["number-{$i}"])) {
                        //     $value = $_POST["number-{$i}"];
                        // } else {
                        //     $value = "";
                        // }
                        $value = '';
                        $value = (isset($_POST["grade-{$i}"])) ? $_POST["grade-{$i}"] : '';


                        echo "<div class='mb-4'>";
                        echo "<label for='grade-{$i}' class='form-label'>Enter Grade for Assignment: {$i}:</label>";
                        echo "<input type='grade' id='grade-{$i}' name='grade-{$i}' value='$value'  class='form-control' >";
                        echo "</div>";

                        $value = (isset($_POST["weight-{$i}"])) ? $_POST["weight-{$i}"] : '';
                        echo "<div class='mb-4'>";
                        echo "<label for='weight-{$i}' class='form-label'>Enter Weight for Assignment: {$i}:</label>";
                        echo "<input type='weight' id='weight-{$i}' name='weight-{$i}' value='$value'  class='form-control' >";
                        echo "</div>";
                    }
                    ?>

                    <!-- Submit Button -->
                    <input type="submit" id="submit" name="submit" value="Calculate" class="btn btn-info my-4">
                </form>
            <?php endif; ?>
        </div>
    </section>
</body>

</html>