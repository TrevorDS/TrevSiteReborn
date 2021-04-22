<?php
require("../SITE_CONFIG.php");
require ("../main/setup.php");

$DATA404;

if (isset($_SESSION["404DATA"])) {
    $DATA404 = $_SESSION["404DATA"];
} else {
    $DATA404 = Get404Defaults();
}

$TITLE404 = $DATA404["title"];
$MESSAGE404 = $DATA404["message"];

// Clear the cache
$_SESSION["404DATA"] = null;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TrevSite Reborn · API</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <style>
            body {
                background-image: url("../imgs/404_page.jpg");
                background-repeat: no-repeat;
                background-position: bottom;
            }
        </style>
    </head>
    <body>

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>
        
        <div id="about-us" class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold"><?= $TITLE404 ?></h1>
            <div class="col-lg-6 mx-auto">
                <hr>
                <p class="lead mb-4"><?= $MESSAGE404 ?></p>
            </div>
        </div>

    </body>
</html>
