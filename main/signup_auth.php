<?php

require("../SITE_CONFIG.php");
require("../main/setup.php");

/*
 * Written by Trevor
 * 4/19/21
 * 
 * Universal Sign-Up Widget: Authenticate
 * Description: This script will handle the Database calls
 * for the sign-up widget.
 * 
 */

// TODO: add POST VERIFICATION
////////////////////////////////////////////////////////////////////////////////
// CONSTANTS
////////////////////////////////////////////////////////////////////////////////
$TABLE = "users";
$TABLE2 = "user_data";

////////////////////////////////////////////////////////////////////////////////
// VARIABLES
////////////////////////////////////////////////////////////////////////////////
$CALLBACK_PAGE = $_POST["CallbackPage"] ?? $DEFAULT_CALLBACK_REDIRECT;
$CALLBACK_PAGE .= "#" . $SIGN_UP_ELEMENT_ID;

////////////////////////////////////////////////////////////////////////////////
// FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
function ErrorMessage($msg) {
    global $SIGN_UP_ERROR_KEY;
    SetErrorMessage($SIGN_UP_ERROR_KEY, $msg);
}

function ValidateInput($u, $e, $p1, $p2) {

    $passed = true;

    // Passwords Match
    if (($p1 !== $p2) && $passed === true) {
        ErrorMessage("Passwords do not match!");
        $passed = false;
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
            ErrorMessage("Username is invalid!");
            $passed = false;
        }
    }

    if ($passed === false) {
        global $CALLBACK_PAGE;
        header("Location: $CALLBACK_PAGE");
        exit;
    }
}

////////////////////////////////////////////////////////////////////////////////
// INIT
////////////////////////////////////////////////////////////////////////////////
// POST VERIFICATION
if (!$_POST) {
    header("Location: $CALLBACK_PAGE");
    exit;
}

ErrorMessage(null);

$username = FilterInput($_POST["username"]);
$email = FilterInput($_POST["email"]);
$password = FilterInput($_POST["password"]);
$password2 = FilterInput($_POST["password2"]);

////////////////////////////////////////////////////////////////////////////////
// RUN-TIME
////////////////////////////////////////////////////////////////////////////////
// Validate Input
ValidateInput($username, $email, $password, $password2);

// Create connection
$conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Check connection
if ($conn->connect_error) {
    ErrorMessage("Connection refused.");
    header("Location: $CALLBACK_PAGE");
    exit;
}

$username_sql = "SELECT * FROM $TABLE WHERE username='$username'";
$username_result = $conn->query($username_sql);

// Account exists
if ($username_result->num_rows > 0) {

    ErrorMessage("Account already exists!");


// Account does not exist
} elseif ($username_result->num_rows == 0) {

    $email_sql = "SELECT * FROM $TABLE WHERE username='$email'";
    $email_result = $conn->query($email_sql);

    // Email is already in use
    if ($email_result->num_rows > 0) {

        ErrorMessage("Email is in use!");


        // Account is good to go!
    } elseif ($email_result->num_rows == 0) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $TABLE (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            
            $username_sql = "SELECT * FROM $TABLE WHERE username='$username'";
            $username_result = $conn->query($username_sql);
            
            if ($username_result->num_rows > 0) {
                
                $row = $username_result->fetch_assoc();
                
                $data_sql = "INSERT INTO $TABLE2 (user_id) VALUES ('" . $row["user_id"] . "')";
                $conn->query($data_sql);
                
                $user_id = $row["user_id"];

                ErrorMessage(null);
                LogIn($user_id, $username, $email);
                
            }
            
        } else {
            ErrorMessage("Error Creating Account.");
        }
    }
}

$conn->close();

header("Location: $CALLBACK_PAGE");
exit;
