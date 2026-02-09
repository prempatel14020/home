<?php
include 'includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tic-Tac-Toe</title>
        <style>
            table {
                border-collapse: collapse;
                margin: 20px auto;
            }

            td {
                width: 60px;
                height: 60px;
                text-align: center;
                font-size: 24px;
                border: 1px solid #000;
                cursor: pointer;
            }

            td:hover {
                background-color: #f0f0f0;
            }
        </style>
    </head>

    <body>

        <h1 style="text-align: center;">Tic-Tac-Toe</h1>
        <p style="text-align: center;">
            <?php echo isset($message) ? $message : "Current Player: " . $_SESSION['current_player']; ?>
        </p>

        <table>
            <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <?php for ($j = 0; $j < 3; $j++): ?>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="cell" value="<?php echo $i . $j; ?>">
                                <?php echo $_SESSION['board'][$i][$j]; ?>
                                <button type="submit" style="width: 100%; height: 100%; opacity: 0;"></button>
                            </form>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>

    </body>

</html>