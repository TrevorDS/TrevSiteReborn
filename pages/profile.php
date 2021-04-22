<?php
require("../SITE_CONFIG.php");
require ("../main/setup.php");

// TODO: add POST VERIFICATION
////////////////////////////////////////////////////////////////////////////////
// CONSTANTS
////////////////////////////////////////////////////////////////////////////////
$IS_USERS_PROFILE = false;

$PROFILE_USERNAME = null;
$PROFILE_EMAIL = null;
$PROFILE_ID = null;
$PROFILE_JOIN_DATE = null;

$PROFILE_PICTURE = $PROFILE_DEFAULT_PROFILE_PICTURE;
$PROFILE_BIO = $PROFILE_DEFAULT_BIO;
$PROFILE_HIDDEN = $PROFILE_DEFAULT_HIDDEN;

$PROFILE_BANNED = false;

////////////////////////////////////////////////////////////////////////////////
// PAGE VALIDATION
////////////////////////////////////////////////////////////////////////////////
$currentUserID = null;

if (isset($_REQUEST["user"])) {
    $currentUserID = $_REQUEST["user"];
}

////////////////////////////////////////////////////////////////////////////////
// CHECK IF CAN VIEW
////////////////////////////////////////////////////////////////////////////////
if ($currentUserID === null) {
    $msg = "There is no user with the UserID of " . $currentUserID . "!";
    Redirect404(true, "User Not Found.", $msg);
    return false;
}

////////////////////////////////////////////////////////////////////////////////
// RENDER PAGE
////////////////////////////////////////////////////////////////////////////////

$profileDATA = GetProfileDataForUser($currentUserID);

if (($profileDATA !== null) && $profileDATA !== "AccountNotFound") {

    $PROFILE_ID = $profileDATA["UserID"];
    $PROFILE_USERNAME = $profileDATA["Username"];
    $PROFILE_EMAIL = $profileDATA["Email"];
    $PROFILE_JOIN_DATE = $profileDATA["JoinDate"];

    $PROFILE_PICTURE = $profileDATA["Picture"];
    $PROFILE_BIO = $profileDATA["Bio"];
    $PROFILE_BG_COLOR = $profileDATA["BGColor"];
    $PROFILE_BG_TEXTCOLOR = $PROFILE_BG_COLORS[$PROFILE_BG_COLOR]["TEXT_COLOR"];
    $PROFILE_HIDDEN = $profileDATA["Hidden"];

    $PROFILE_BANNED = $profileDATA["Banned"];
} elseif ($profileDATA === "AccountNotFound") {

    $msg = "There is no user with the UserID of " . $currentUserID . "!";
    Redirect404(true, "User Not Found.", $msg);

    return false;
}

// Is this the user's profile?
if ($PROFILE_ID === $USERID) {
    if (!isset($_POST["ViewPageAsUser"])) {
        $IS_USERS_PROFILE = true;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php if ($IS_USERS_PROFILE === false) { ?>

            <title><?= $PROFILE_USERNAME ?>'s Profile</title>

        <?php } elseif ($IS_USERS_PROFILE === true) { ?>

            <title>Your Profile</title>

        <?php } ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <style>
            body {
                background-color: <?= $PROFILE_BG_COLOR ?>; 
                color: <?= $PROFILE_BG_TEXTCOLOR ?>;
            }
            
            .inputToAnchorCSS, .collapsible {
                background: none!important;
                border: none;
                padding: 0!important;
                /*optional*/
                font-family: arial, sans-serif;
                /*input has OS specific font-family*/
                color: <?= $PROFILE_BG_TEXTCOLOR ?>;
                text-decoration: underline;
                cursor: pointer;
            }

            /* THANKS FROM: https://www.w3schools.com/howto/howto_js_collapsible.asp */
            /* Style the collapsible content. Note: hidden by default */
            .content {
                padding: 0 18px;
                background-color: <?= $PROFILE_BG_COLOR ?>;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.2s ease-out;
            }
        </style>
    </head>
    <body>

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>

        <!-- Render Page-->
        <?php if ($IS_USERS_PROFILE === false) { ?>

            <!-- View another user's profile-->
            <div id="about-us" class="px-4 pt-5 my-5 text-center border-bottom">
                <h1 class="display-4 fw-bold">Welcome to <?= $PROFILE_USERNAME ?>'s Profile!</h1>
                <div class="col-lg-6 mx-auto">
                    <div class="container px-5">
                        <img src="<?= $PROFILE_PICTURE ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="100" height="100" loading="lazy">
                    </div>
                    <p class="lead mb-4">Did you know they joined on <?= date("F j, Y", strtotime($PROFILE_JOIN_DATE)) ?>?</p>
                    <hr>
                    <h3><?= $PROFILE_USERNAME ?>'s Bio:</h3>
                    <p class="lead mb-4" style="padding-bottom: 15em;"><?= $PROFILE_BIO ?></p>
                </div>
            </div>

        <?php } elseif ($IS_USERS_PROFILE === true) { ?>

            <!-- YOUR PROFILE-->
            <div id="about-us" class="px-4 pt-5 my-5 text-center border-bottom">
                <h1 class="display-4 fw-bold">Welcome to Your Profile!</h1>

                <form action="profile?user=<?= $USERID ?>" method="POST">
                    <input class="inputToAnchorCSS" type="submit" name="ViewPageAsUser" value="View Profile as Guest" />
                </form>

                <button type="button" class="collapsible">Edit Profile Settings</button>
                <div class="content">
                    <form action="../main/profilesettings_auth.php" method="POST">
                        <input type="hidden" name="UserID" value="<?= $USERID ?>" />
                        1. Background Color
                        <br>
                        <select name="colors" id="colors">
                            <?php
                            
                            $COLORS_LIST = $PROFILE_BG_COLORS;
                            
                            foreach ($COLORS_LIST as $ColorKEY => $ColorDATA) {
                                
                                echo '<option value="' . $ColorKEY . '">' . $ColorDATA["TEXT"] . '</option>';
                                
                            }
                            
                            ?>
                        </select>
                        <br><br>
                        <input type="submit" value="Update Settings" />
                    </form>
                </div> 

                <br>

                <div class="col-lg-6 mx-auto">
                    <div class="container px-5">

                        <button type="button" class="collapsible">Edit Profile Picture</button>
                        <div class="content">
                            <form action="../main/fileupload_auth.php" method="post" enctype="multipart/form-data">
                                Select image to upload:
                                <br><br>
                                <?php
                                if ($profileErrorMessage !== "") {
                                    echo "<p style='color: red;'>$profileErrorMessage</p>";
                                    ResetError($PROFILE_UPLOAD_ERROR_KEY);
                                }
                                ?>
                                <input type="hidden" name="UserID" value="<?= $USERID ?>" />
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <br>
                                <br>
                                <input type="submit" value="Upload Image" name="submit">
                            </form>
                        </div> 

                        <img src="<?= $PROFILE_PICTURE ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="100" height="100" loading="lazy">
                    </div>
                    <p class="lead mb-4">Did you know you joined on <?= date("F j, Y", strtotime($PROFILE_JOIN_DATE)) ?>?</p>

                    <hr>

                    <h3>Your Bio:</h3>
                    <button type="button" class="collapsible">Edit Bio</button>
                    <div class="content">
                        <form action="../main/updatebio_auth.php" method="POST">
                            You can have a <?= $MAX_BIO_LEN ?> character Bio!
                            <br><br>
                            <input type="hidden" name="UserID" value="<?= $USERID ?>" />
                            <textarea style="width: 30em; height: 10em;" type="text" name="updateBio" id="updateBio"><?= $PROFILE_BIO ?></textarea>
                            <br>
                            <br>
                            <input type="submit" value="Update Bio" name="submit">
                        </form>
                    </div> 
                    <p class="lead mb-4" style="padding-bottom: 15em;"><?= $PROFILE_BIO ?></p>
                </div>
            </div>

        <?php } ?>

        <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            }
        </script>
    </body>
</html>
