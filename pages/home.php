<?php
require("../SITE_CONFIG.php");
require ("../main/setup.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>TrevSite Reborn · Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The Home Page of TrevSite: Reborn.">
        <meta name="author" content="Trevor Sherrill, Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.82.0">

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/heroes/">
        <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">

        <style>
            /* Main */
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            /* CUSTOM */
            .flame-banner {
                color: white;
                background-image: url("../imgs/flame-banner.jpg");
                background-repeat: no-repeat;
                background-size: cover;
            }

            .signup-banner {
                color: white;
                background-image: url(../imgs/signup-banner.jpg);
                background-repeat: no-repeat;
                background-size: cover;
            }

            .footer-icon-logo {
                height: 2em;
                width: 2em;
            }
        </style>

        <!-- Custom styles for this template -->
        <link href="https://getbootstrap.com/docs/5.0/examples/heroes/heroes.css" rel="stylesheet">

        <!-- TrevSite CSS -->
        <link href="../css/main.css" rel="stylesheet" />
    </head>
    <body>

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>

        <div class="px-4 py-5 my-5 text-center flame-banner">
            <img class="d-block mx-auto mb-4" src="../imgs/fav-icon.png" alt="" width="75" height="75">
            <h1 class="display-5 fw-bold">TrevSite: Reborn</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Welcome to TrevSite: Reborn! A website showcasing open source code and documentation on how to become a better developer.</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="get-started" class="btn btn-primary btn-lg px-4 me-sm-3">Get Started</a>
                    <a href="#about-us" class="btn btn-secondary btn-lg px-4">About TrevSite</a>
                </div>
            </div>
        </div>

        <div class="b-example-divider"></div>

        <?php
        $showSignUp = require("../main/signup.php");

        if ($showSignUp !== false) {
            ?>

            <div class="b-example-divider"></div>

        <?php } ?>

        <div id="about-us" class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold">About Us?</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">TrevSite was founded in early 2020, but it has been adapted to be much more modern and more dynamic than ever before.</p>
                <hr>
                <h3>TrevSite: Reborn</h3>
                <div class="container px-5">
                    <img src="../imgs/fav-icon.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="100" height="100" loading="lazy">
                </div>
                <p class="lead mb-4">TrevSite: Reborn is a new adaptation of the original TrevSite model. It has been further adapted to be an informational, documentation/API resource to better help aspiring developers be just a little better.</p>
                <hr>
                <h3>Founder</h3>
                <div class="container px-5">
                    <img src="../imgs/trayeus.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="100" height="100" loading="lazy">
                </div>
                <p class="lead mb-4">The founder of TrevSite is Trevor, also know in the developer world as <a href="https://www.twitter.com/Trayeus" target="_blank" alt="">@Trayeus</a>. Trevor has been a developer since around 2013 and has been a programmer since about 2015.</p>
            </div>
        </div>

        <div class="b-example-divider"></div>

        <div class="bg-dark text-secondary px-4 py-5 text-center">
            <div class="py-5">
                <h1 class="display-5 fw-bold text-white">Our Socials?</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="fs-5 mb-4">Keep up-to-date with our Socials down below!</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="https://www.twitter.com/Trayeus" target="_blank" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">
                            <img class="footer-icon-logo" src="../imgs/Twitter.png" alt="Twitter Logo" />
                        </a>
                        <a href="https://www.youtube.com/channel/UClcSd2fNrOC3SdzkTD9SLuw" target="_blank" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">
                            <img class="footer-icon-logo" style="width: 2.5em" src="../imgs/Youtube.png" alt="Twitter Logo" />
                        </a>
                    </div>
                </div>
            </div>
            <a href="https://www.w3schools.com/" target="_blank" alt="W3schools">
                <img style="height: 4em; width: 10em;" src="../imgs/w3schools-certified.png" alt="W3schools Certified" />
            </a>
            <small class="text-muted">
                · TrevSite 2020-2021.
            </small>
        </div>

        <div class="b-example-divider mb-0"></div>


        <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


    </body>
</html>