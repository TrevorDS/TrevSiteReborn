<?php

include("../SITE_CONFIG.php");
include("../main/setup.php");
/*
 * Written by Trevor
 * 4/19/21
 * 
 * Universal Log-In: Authenticate
 * Description: This script will handle the Database calls
 * for the log-in widget.
 * 
 */
////////////////////////////////////////////////////////////////////////////////
// CONSTANTS
////////////////////////////////////////////////////////////////////////////////
global $DB_SERVER_NAME;
global $DB_USERNAME;
global $DB_PASSWORD;
global $DB_NAME;

$TABLE = "users";

////////////////////////////////////////////////////////////////////////////////
// VARIABLES
////////////////////////////////////////////////////////////////////////////////
$CALLBACK = ($PAGES . "log-in");

////////////////////////////////////////////////////////////////////////////////
// FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
function ErrorMessage($msg) {
    global $LOG_IN_ERROR_KEY;
    SetErrorMessage($LOG_IN_ERROR_KEY, $msg);
}

function ValidateInput($u, $p) {

    $passed = true;

    // Password isn't blank
    if ((strlen($p) > 0) && passed === true) {

        $total_spaces = 0;
        for ($i = 0; $i < strlen($p); $i++) {
            if (substr($p, $i, $i) === " ") {
                $total_spaces++;
            }
        }
        if ($total_spaces === strlen($u)) { ErrorMessage("Credentials do not match."); $passed = false; }
    }

    // Username isn't blank
    if ((strlen($u) > 0) && passed === true) {

        $total_spaces = 0;
        for ($i = 0; $i < strlen($u); $i++) {
            if (substr($u, $i, $i) === " ") {
                $total_spaces++;
            }
        }

        if ($total_spaces === strlen($u)) { ErrorMessage("Credentials do not match."); $passed = false; }
    }

    if ($passed === false) { global $CALLBACK; header("Location: $CALLBACK"); exit; }
}

////////////////////////////////////////////////////////////////////////////////
// INIT
////////////////////////////////////////////////////////////////////////////////
// POST VERIFICATION
if (!$_POST) {
    header("Location: $CALLBACK");
    exit;
}

if (isset($_POST["LogOut"])) {
    LogOut();
    header("Location: $DEFAULT_CALLBACK_REDIRECT");
    exit;
}

ErrorMessage(null);

echo "INIT <br>";

$username = FilterInput($_POST["username"]);
$password = FilterInput($_POST["password"]);

echo "Filter function is OK! <br>";

////////////////////////////////////////////////////////////////////////////////
// RUN-TIME
////////////////////////////////////////////////////////////////////////////////
// Validate Input
ValidateInput($username, $password);

echo "ATTEMPING CONNECTION... <br>";

// Create connection
$conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

echo "CONNECTED! Here's the data: <br>" . $conn;
echo "<br>";

// Check connection
if ($conn->connect_error) {
    ErrorMessage("Connection refused.");
    header("Location: $CALLBACK");
    exit;
}

echo "Before running SQL... <br>";

$username_sql = "SELECT * FROM $TABLE WHERE username='$username'";
$username_result = $conn->query($username_sql);

echo "Ran SQL! <br>";

// Account exists
if ($username_result->num_rows > 0) {
    
    echo "There was an account! <br>";

    $row = $username_result->fetch_assoc();

    $PASSWORDS_MATCH = password_verify($password, $row["password"]);

    if ($PASSWORDS_MATCH === true) {

        $user_id = $row["user_id"];

        ErrorMessage(null);
        LogIn($user_id, $username, $email);
    } else {

        ErrorMessage("Passwords do not match!");
    }

// Account does not exist
} elseif ($username_result->num_rows == 0) {
    
    echo "There was NOT an account! <br>";

    ErrorMessage("Account does not exist!");
}

echo "Close Connection... <br>";

$conn->close();

echo "Closed. Heading back to $CALLBACK! <br>";

header("Location: $CALLBACK");

echo "Succes! Should have redirected...";
exit;

echo "This should NOT EVER run!";