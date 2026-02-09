<?php
session_start();

// Initialize the game board
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = array_fill(0, 3, array_fill(0, 3, ''));
    $_SESSION['current_player'] = 'X';
}

// Handle the player's move
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cell'])) {
    $cell = $_POST['cell'];
    $row = intval($cell[0]);
    $col = intval($cell[1]);

    // Check if the cell is empty
    if ($_SESSION['board'][$row][$col] === '') {
        $_SESSION['board'][$row][$col] = $_SESSION['current_player'];
        // Check for a winner
        if (checkWinner($_SESSION['board'], $_SESSION['current_player'])) {
            $message = "Player " . $_SESSION['current_player'] . " wins!";
            resetGame();
        } elseif (isBoardFull($_SESSION['board'])) {
            $message = "It's a draw!";
            resetGame();
        } else {
            // Switch player
            $_SESSION['current_player'] = $_SESSION['current_player'] === 'X' ? 'O' : 'X';
        }
    }
}

// Function to check for a winner
function checkWinner($board, $player)
{
    // Check rows, columns, and diagonals
    for ($i = 0; $i < 3; $i++) {
        if (
            ($board[$i][0] === $player && $board[$i][1] === $player && $board[$i][2] === $player) ||
            ($board[0][$i] === $player && $board[1][$i] === $player && $board[2][$i] === $player)
        ) {
            return true;
        }
    }
    if (
        ($board[0][0] === $player && $board[1][1] === $player && $board[2][2] === $player) ||
        ($board[0][2] === $player && $board[1][1] === $player && $board[2][0] === $player)
    ) {
        return true;
    }
    return false;
}

// Function to check if the board is full
function isBoardFull($board)
{
    foreach ($board as $row) {
        if (in_array('', $row)) {
            return false;
        }
    }
    return true;
}

// Function to reset the game
function resetGame()
{
    $_SESSION['board'] = array_fill(0, 3, array_fill(0, 3, ''));
    $_SESSION['current_player'] = 'X';
}
?>