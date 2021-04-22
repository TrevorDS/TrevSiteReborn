<?php
require("../SITE_CONFIG.php");
require ("../main/setup.php");
?>
<?php
if (isset($_POST["NoThanks"])) {
    $_SESSION["NoThanksButton"] = true;
}

$check = false;

if (isset($_SESSION["NoThanksButton"])) {
    $check = true;
}
if (isset($_SESSION["UserDATA"])) {
    $check = true;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TrevSite Reborn · Get Started</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <style>
            #noThanksButton {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 10em;
            }
        </style>

        <!-- TrevSite CSS -->
        <link href="../css/main.css" rel="stylesheet" />
    </head>
    <body>

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>

        <div class="b-example-divider"></div>

        <?php if ($check === false) { ?>

            <?php require("../main/signup.php"); ?>

            <form action="<?= GetPageName($pageName) ?>" method="POST">
                <input type="hidden" id="NoThanks" name="NoThanks" value="-" />
                <input type="submit" id="noThanksButton" class="btn btn-lg btn-secondary" value="No thanks" />
            </form>

            <div class="b-example-divider"></div>

        <?php } elseif ($check === true) { ?>

            <div class="container col-xl-10 col-xxl-8 px-4 py-5">
                <div class="row align-items-center g-5 py-5" style="display: block;">
                    <div style="width: 50%; float: left;" class="col-lg-7 text-center text-lg-start">
                        <h1 style="color: purple;" class="display-4 fw-bold lh-1 mb-3">Get Started Today.</h1>
                        <h5 style="color: purple;">What can you do to better yourself?</h5>
                        <p style="margin-top: 1.5em;" class="col-lg-10 fs-4">To become a better programmer, one must believe they can be one.</p>
                        <p>Not only that, it can take years of practice and sheer willpower to master the art of coding.</p>
                        <p>But, let's get to the point: what are some resources that you can use to become a better programmer?</p>
                        <h5 style="margin-top: 1.5em;">To name a few:</h5>
                        <ol>
                            <li>
                                <a style="font-size: 25;" href="https://www.w3schools.com/" target="_blank">W3Schools</a> is a great resource for documentation and learning about all things code.
                                They have plenty of resources on web development from HTML & CSS to PHP and JavaScript.
                            </li>
                            <li>
                                <a style="font-size: 25;" href="https://edabit.com/" target="_blank">Edabit</a> is an <b>excellent</b> resource for learning to code. There are challenges that <em>other developers</em>
                                set and make that can test your skills from very beginner to professional level challenges.
                            </li>
                            <li>
                                <a style="font-size: 25;" href="https://www.roblox.com/create" target="_blank">ROBLOX Studio</a> is a great way to learn about Object-Oriented Programming (OOP).
                                You can get some hands on experience with 3D game development on a growing platform with millions of users.
                            </li>
                        </ol>
                    </div>
                    <div style="width: 50%; float: right;" class="col-lg-7 text-center text-lg-start">
                        <img style="width: 100%; height: 37.5em;" src="../imgs/roblox-ceo.jpg" alt="CEO of ROBLOX" />
                        <small style="width: 100%">David Baszucki, CEO of ROBLOX Corporation</small>
                    </div>
                </div>
            </div>

            <div style="width: fit-content; margin: auto; margin-top: 50em; margin-bottom: 5em;">
                <h5>
                    Try <a href="documentation">our guide</a> on learning how to become a Developer!
                </h5>
            </div>


        <?php } ?>

    </body>
</html>