<?php

require("../SITE_CONFIG.php");
require("../main/setup.php");
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
$TABLE = "users";

////////////////////////////////////////////////////////////////////////////////
// VARIABLES
////////////////////////////////////////////////////////////////////////////////
$CALLBACK = ($PAGES . "log-in.php");

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

        if ($total_spaces === strlen($u)) {
            ErrorMessage("Credentials do not match.");
            $passed = false;
        }
    }

    // Username isn't blank
    if ((strlen($u) > 0) && passed === true) {

        $total_spaces = 0;
        for ($i = 0; $i < strlen($u); $i++) {
            if (substr($u, $i, $i) === " ") {
                $total_spaces++;
            }
        }

        if ($total_spaces === strlen($u)) {
            ErrorMessage("Credentials do not match.");
            $passed = false;
        }
    }

    if ($passed === false) {
        global $CALLBACK;
        header("Location: $CALLBACK");
        exit;
    }
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

$username = FilterInput($_POST["username"]);
$password = FilterInput($_POST["password"]);

////////////////////////////////////////////////////////////////////////////////
// RUN-TIME
////////////////////////////////////////////////////////////////////////////////
// Validate Input
ValidateInput($username, $password);

// Create connection
$conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    ErrorMessage("Connection refused.");
    header("Location: $CALLBACK");
    exit;
}

$username_sql = "SELECT * FROM $TABLE WHERE username='$username'";
$username_result = $conn->query($username_sql);

// Account exists
if ($username_result->num_rows > 0) {

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

    ErrorMessage("Account does not exist!");
}

$conn->close();

header("Location: $CALLBACK");
exit;
