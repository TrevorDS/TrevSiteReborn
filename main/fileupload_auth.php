<?php

require("../SITE_CONFIG.php");
require("../main/setup.php");
/*
 * Written by Trevor
 * 4/19/21
 * 
 * Universal CONFIG for the site! (Some data here might be confidential,
 * so make sure to keep it safe!
 * 
 * CREDITS: https://www.w3schools.com/php/php_file_upload.asp
 * 
 */
////////////////////////////////////////////////////////////////////////////////
// CONSTANTS
////////////////////////////////////////////////////////////////////////////////
$TABLE = "user_data";
$UserID = $_POST["UserID"];
$CALLBACK = $PAGES . "profile?user=$UserID";

if (!isset($UserID) || $UserID === null) {
    $CALLBACK = $DEFAULT_CALLBACK_REDIRECT;
}

$target_dir = $FILE_UPLOADS_PROFILE_PICTURES;

////////////////////////////////////////////////////////////////////////////////
// Variables
////////////////////////////////////////////////////////////////////////////////
$FILE_PERM_NAME = "USER_" . $UserID . "_" . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $FILE_PERM_NAME;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////
function ErrorMessage($msg) {
    global $PROFILE_UPLOAD_ERROR_KEY;
    SetErrorMessage($PROFILE_UPLOAD_ERROR_KEY, $msg);
}

////////////////////////////////////////////////////////////////////////////////
// INIT
////////////////////////////////////////////////////////////////////////////////
// POST VERIFICATION
if (!$_POST) {
    header("Location: $CALLBACK");
    exit;
}

////////////////////////////////////////////////////////////////////////////////
// RUN-TIME
////////////////////////////////////////////////////////////////////////////////
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check !== false) {

        $uploadOk = 1;
    } else {

        ErrorMessage("File is not an image.");
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {

    $deleted_file = unlink($target_file);

    if (!$deleted_file) {
        ErrorMessage("Sorry, there was an error uploading your file.");
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {

    ErrorMessage("Sorry, your file is too large.");
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

    ErrorMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

    ErrorMessage("Sorry, your file was not uploaded.");

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        // Create connection
        $conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

        // Check connection
        if ($conn->connect_error) {
            ErrorMessage("Connection refused.");
            header("Location: $CALLBACK");
            exit;
        }

        $sql = "UPDATE $TABLE SET profile_picture='" . $FILE_PERM_NAME . "' WHERE user_id='$UserID'";

        if ($conn->query($sql) === false) {
            ErrorMessage("Sorry, your file was not uploaded.");
            unlink($target_file);
        }

        $conn->close();
        
    } else {

        ErrorMessage("Sorry, there was an error uploading your file.");
    }
}


header("Location: $CALLBACK");
exit;