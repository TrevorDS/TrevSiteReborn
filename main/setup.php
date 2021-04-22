<?php
/*
 * Written by Trevor
 * 4/16/21
 * 
 * Universal Set-Up: Import into each page.
 * 
 */
session_start();

////////////////////////////////////////////////////////////////////////////////
// UNIVERSAL / UTIL FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
function GetPageName($url) {
    $info = pathinfo($url);
    $file_name = basename($url, '.' . $info['extension']);
    return $file_name;
}

function ConvertBinaryBoolean($binary) {
    if ($binary === 1) {
        return true;
    }
    return false;
}

function ConvertBooleanToString($bool) {
    if ($bool === true) {
        return "true";
    } elseif ($bool === false) {
        return "false";
    }
    return null;
}

////////////////////////////////////////////////////////////////////////////////
// Profile Functions
////////////////////////////////////////////////////////////////////////////////
function GetUserProfileDATA($currID) {

    $USER_TABLE = "users";

    global $DB_SERVER_NAME;
    global $DB_USERNAME;
    global $DB_PASSWORD;
    global $DB_NAME;

    // Create connection
    $conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Check connection
    if ($conn->connect_error) { Redirect404(true, "Connection refused.", "No response from TrevSite."); return false; }

    $account_sql = "SELECT * FROM $USER_TABLE WHERE user_id='$currID'";
    $account_result = $conn->query($account_sql);

    // Account DOES NOT exist
    if ($account_result->num_rows === 0) {
        return "AccountNotFound";
    }

    $account_row = $account_result->fetch_assoc();
    $profileDATA = [];

    $profileDATA["UserID"] = $account_row["user_id"];
    $profileDATA["Username"] = $account_row["username"];
    $profileDATA["Email"] = $account_row["email"];
    $profileDATA["JoinDate"] = $account_row["join_date"];

    return $profileDATA;
}

function GetProfileDATA($db_conn = null, $currID) {

    global $DB_SERVER_NAME;
    global $DB_USERNAME;
    global $DB_PASSWORD;
    global $DB_NAME;

    $PROFILE_TABLE = "user_data";
    $profileDATA = null;

    if ($db_conn === null) {
        // Create connection
        $db_conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    }

    $db_sql = "SELECT * FROM $PROFILE_TABLE WHERE user_id='$currID'";
    $db_result = $db_conn->query($db_sql);

    if ($db_result->num_rows > 0) {

        $profileDATA = $db_result->fetch_assoc();
    }

    $db_conn->close();

    return $profileDATA;
}

function GetDaysOnSite($jd = null) {
    
    $osTime = new DateTime(); //start time
    $osTime = $osTime->format('Y-m-d H:i:s');
    $osTime = strtotime($osTime);
    $joinTime = strtotime($jd);
    $timeOnSite = ($osTime - $joinTime);
    $daysOnSite = ($timeOnSite / (3600 * 24));
    
    $daysOnSite = round($daysOnSite, 0);
    
    return $daysOnSite;
}

function GetProfileDataForUser($currID, $db_conn = null) {

    $userProfileDATA = GetUserProfileDATA($currID);
    $profileDATA = GetProfileDATA($db_conn, $currID);

    global $PROFILE_DEFAULT_PROFILE_PICTURE; global $PROFILE_DEFAULT_BIO;
    global $PROFILE_DEFAULT_BG_COLOR; global $FILE_UPLOADS_PROFILE_PICTURES;

    $DATA = [];

    $DATA["UserID"] = $userProfileDATA["UserID"];
    $DATA["Username"] = $userProfileDATA["Username"];
    $DATA["Email"] = $userProfileDATA["Email"];
    $DATA["JoinDate"] = $userProfileDATA["JoinDate"];

    $daysOnSite = GetDaysOnSite($DATA["JoinDate"]);

    $DATA["Banned"] = ConvertBinaryBoolean($profileDATA["banned"]);
    $DATA["Picture"] = $PROFILE_DEFAULT_PROFILE_PICTURE;
    $DATA["Bio"] =  sprintf($PROFILE_DEFAULT_BIO, $daysOnSite);
    $DATA["BGColor"] = $PROFILE_DEFAULT_BG_COLOR;
    $DATA["Hidden"] = ConvertBinaryBoolean($profileDATA["profile_hidden"]);

    if ($profileDATA["profile_picture"] !== "") { $DATA["Picture"] = $FILE_UPLOADS_PROFILE_PICTURES . $profileDATA["profile_picture"]; }
    if ($profileDATA["bio"] !== "") { $DATA["Bio"] = $profileDATA["bio"]; }
    if ($profileDATA["profile_bg_color"] !== "") { $DATA["BGColor"] = $profileDATA["profile_bg_color"]; }

    return $DATA;
}

////////////////////////////////////////////////////////////////////////////////
// 404 Page
////////////////////////////////////////////////////////////////////////////////
function Get404Defaults() {
    return array(
        "title" => "404 Page Not Found!",
        "message" => ""
    );
}

function Redirect404($redirect, $title, $msg) {

    $_SESSION["404DATA"] = Get404Defaults();

    if ($title !== null) {
        $_SESSION["404DATA"]["title"] = $title;
    }
    if ($msg !== null) {
        $_SESSION["404DATA"]["message"] = $msg;
    }

    if ($redirect === true) {
        header("Location: 404");
    }
}

////////////////////////////////////////////////////////////////////////////////
// User DATA / Log in DATA
////////////////////////////////////////////////////////////////////////////////
function LogIn($user_id, $username, $email) {

    $_SESSION["UserDATA"] = array(
        "user_id" => $user_id,
        "username" => $username,
        "email" => $email
    );
}

function LogOut() {
    $_SESSION["UserDATA"] = null;
}

function CheckIfLoggedIn() {
    if (isset($_SESSION["UserDATA"])) {
        return true;
    }
    return false;
}

$LOGGED_IN = CheckIfLoggedIn();
$USERID = null;
$USERNAME = null;
$EMAIL = null;

if ($LOGGED_IN === true) {
    $USER_DATA = $_SESSION["UserDATA"];

    $USERID = $USER_DATA["user_id"];
    $USERNAME = $USER_DATA["username"];
    $EMAIL = $USER_DATA["email"];
}

////////////////////////////////////////////////////////////////////////////////
// FILTER / VALIDATION FUNCTIONS
////////////////////////////////////////////////////////////////////////////////
function FilterInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

////////////////////////////////////////////////////////////////////////////////
// SIGN UP ERROR
////////////////////////////////////////////////////////////////////////////////
function GetError($key) {
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
    return "";
}

function SetErrorMessage($key, $msg) {
    $_SESSION[$key] = $msg;
}

function ResetError($key) {
    $_SESSION[$key] = null;
}

$signupErrorMessage = GetError($SIGN_UP_ERROR_KEY);
$loginErrorMessage = GetError($LOG_IN_ERROR_KEY);
$profileErrorMessage = GetError($PROFILE_UPLOAD_ERROR_KEY);

////////////////////////////////////////////////////////////////////////////////
// UNIVERSAL CONSTANTS
////////////////////////////////////////////////////////////////////////////////
$pageName = $_SERVER["PHP_SELF"];
?>
<!-- Favicons -->
<link rel="icon" href="../imgs/fav-icon.png" sizes="32x32" type="image/png">

<!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">