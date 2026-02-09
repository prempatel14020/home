<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Simple To-Do List</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="Add a new task" required>
            <button type="submit">Add Task</button>
        </form>
        <h2>Current Tasks</h2>
        <ul>
            <?php
            $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES);
            foreach ($tasks as $task) {
                echo "<li>" . htmlspecialchars($task) . " <a href='?remove=" . urlencode($task) . "'>Remove</a></li>";
            }
            ?>
        </ul>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['task'])) {
        $task = trim($_POST['task']);
        file_put_contents('tasks.txt', $task . PHP_EOL, FILE_APPEND);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_GET['remove'])) {
        $remove_task = trim($_GET['remove']);
        $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES);
        $tasks = array_filter($tasks, function ($t) use ($remove_task) {
            return $t !== $remove_task;
        });
        file_put_contents('tasks.txt', implode(PHP_EOL, $tasks) . PHP_EOL);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    ?>
</body>

</html>