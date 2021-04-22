<?php
/*
 * Written by Trevor
 * 4/19/21
 * 
 * Universal CONFIG for the site! (Some data here might be confidential,
 * so make sure to keep it safe!
 * 
 */
////////////////////////////////////////////////////////////////////////////////
// DEBUG
////////////////////////////////////////////////////////////////////////////////
$LOCAL_MACHINE = true;

////////////////////////////////////////////////////////////////////////////////
// CONSTANTS
////////////////////////////////////////////////////////////////////////////////
$PAGES = "../pages/";
$FILE_UPLOADS_FOLDER = "../uploads/";
$FILE_UPLOADS_PROFILE_PICTURES = ($FILE_UPLOADS_FOLDER . "profile-pics/");
$DEFAULT_CALLBACK_REDIRECT = $PAGES . "home";

$SIGN_UP_ERROR_KEY = "sign-up-error";
$SIGN_UP_ELEMENT_ID = "signup-banner";

$LOG_IN_ERROR_KEY = "log-in-error";

$PROFILE_UPLOAD_ERROR_KEY = "profile-file-error";

////////////////////////////////////////////////////////////////////////////////
// CONFIG
////////////////////////////////////////////////////////////////////////////////
$websiteName = "TrevSite: Reborn";
$iconDestination = "home";

$MAX_USERNAME_LEN = 20;
$MAX_EMAIL_LEN = 50;
$MAX_PASSWORD_LEN = 20;

$MAX_BIO_LEN = 500;

$PROFILE_DEFAULT_PROFILE_PICTURE = "../imgs/fav-icon.png";
$PROFILE_DEFAULT_BIO = "This user has member of the TrevSite Community for %s day(s)!";
$PROFILE_DEFAULT_BG_COLOR = "lightgray";
$PROFILE_DEFAULT_HIDDEN = false;

$PROFILE_BG_COLORS = array(
    
    "white" => array(
        "TEXT" => "White",
        "TEXT_COLOR" => "black"
    ),
    "lightgray" => array(
        "TEXT" => "Light Gray",
        "TEXT_COLOR" => "black"
    ),
    "purple" => array(
        "TEXT" => "Purple",
        "TEXT_COLOR" => "white"
    ),
    "red" => array(
        "TEXT" => "Red",
        "TEXT_COLOR" => "white"
    )
    
);

////////////////////////////////////////////////////////////////////////////////
// DATA BASE LOG-IN INFORMATION!
////////////////////////////////////////////////////////////////////////////////
$DB_SERVER_NAME = getenv('DB_SERVER_NAME');
$DB_USERNAME = getenv('DB_USERNAME');
$DB_PASSWORD = getenv('DB_PASSWORD');
$DB_NAME = getenv("DB_NAME");

if ($LOCAL_MACHINE === true) {
    $DB_SERVER_NAME = "localhost";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";
    $DB_NAME = "TrevSiteReborn";
}

////////////////////////////////////////////////////////////////////////////////