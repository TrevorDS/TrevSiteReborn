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
        <title>TrevSite Reborn · API</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <style>
            #noThanksButton {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 10em;
            }

            pre code {
                background-color: #eee;
                border: 1px solid #999;
                display: block;
                padding: 20px;
            }
        </style>

        <!-- TrevSite CSS -->
        <link href="../css/main.css" rel="stylesheet" />
    </head>
    <body>

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>

        <?php if ($check === false) { ?>

            <?php require("../main/signup.php"); ?>

            <form action="<?= GetPageName($pageName) ?>" method="POST">
                <input type="hidden" id="NoThanks" name="NoThanks" value="-" />
                <input type="submit" id="noThanksButton" class="btn btn-lg btn-secondary" value="No thanks" />
            </form>

            <div class="b-example-divider"></div>

        <?php } elseif ($check === true) { ?>

            <main>
                <div class="container col-xl-10 col-xxl-8 px-4 py-5">
                    <div class="row align-items-center g-5 py-5" style="display: block;">
                        <div style="width: 50%; float: left;" class="col-lg-7 text-center text-lg-start">
                            <h1 style="color: purple;" class="display-4 fw-bold lh-1 mb-3">Become a Developer?</h1>
                            <h5 style="color: purple;">Let's Start Today.</h5>
                            <p style="margin-top: 1.5em;" class="col-lg-10 fs-4">In this quick guide we will show you how to program a very simplistic game on the ROBLOX platform.</p>
                            <p><b>NOTE:</b> This tutorial should take about 30 minutes to complete.</p>
                            <h5 style="margin-top: 1.5em;">Let's start! What is the quick run-down?</h5>
                            <ol>
                                <li>
                                    <a href="#task-1">
                                        Quickly read about what Object-Oriented Programming is and can do.
                                    </a>
                                </li>
                                <li>
                                    <a href="#task-2">
                                        Learn about ROBLOX and ROBLOX Studio.
                                    </a>
                                </li>
                                <li>
                                    <a href="#task-3">
                                        Download ROBLOX Studio (light download).
                                    </a>
                                </li>
                                <li>
                                    <a href="#task-4">
                                        Start on your first ROBLOX game (a quick app).
                                    </a>
                                </li>
                                <li>
                                    <a href="#task-5">
                                        Make sure the app is debugged, tested, and works.
                                    </a>
                                </li>
                                <li>
                                    <a href="#task-6">
                                        Congrats, you're done! Show off your app!
                                    </a>
                                </li>
                            </ol>
                        </div>
                        <div style="width: 50%; float: right;" class="col-lg-7 text-center text-lg-start">
                            <img style="width: 150%; height: 37.5em;" src="../imgs/roblox-grid.jpg" alt="CEO of ROBLOX" />
                            <small style="width: 100%">Various Games on the ROBLOX Platform (source: <a href="https://www.roblox.com" target="_blank">www.roblox.com</a>)</small>
                        </div>
                    </div>
                </div>
            </main>

            <div style="width: 100%;" class="b-example-divider"></div>

            <div class="container col-xl-10 col-xxl-8 px-4 py-5">
                <div class="row align-items-center g-5 py-5" style="display: block;">
                    <div style="width: 50%; float: left;" class="col-lg-7 text-center text-lg-start">
                        <br>
                        <p id="task-1" style="margin-top: 1.5em;" class="col-lg-10 fs-4">
                            1. Okay, what is OOP really?
                        </p>
                        <p><b>NOTE:</b> Object-Oriented Programmed is often shortened to OOP.</p>

                        <h5 style="margin-top: 1.5em;">What is OOP?</h5>
                        <p>
                            Object-oriented programming is a programming paradigm based on the 
                            concept of "objects", which can contain data and code: data in the 
                            form of fields, and code, in the form of procedures. A feature of 
                            objects is that an object's own procedures can access and often 
                            modify the data fields of itself. (source:
                            <a target="_blank" href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiJuqqnrJHwAhWEVs0KHaVJBHwQmhMwJXoECEAQAg&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FObject-oriented_programming&usg=AOvVaw0U8UogMT5Cr_429wtLRNWa">Wikipedia</a>)
                        </p>

                        <h5 style="margin-top: 1.5em;">Great, what does this really mean?</h5>
                        <p>
                            Right, so this super over complicated explanation might seem very
                            imitating, but don't be alarmed!
                        </p>
                        <p>
                            We're going to break it down.
                        </p>
                        <ul>
                            <li>
                                The idea of OOP was coined by <b>Alan Kay</b> around 1966 / 1967. (source: <a href="https://medium.com/javascript-scene/the-forgotten-history-of-oop-88d71b9b2d9f">www.medium.com</a>)
                            </li>
                            <li>
                                Although <b>the idea of OOP</b> dates back all the way to 1961 / 1962. (source: <a href="https://medium.com/javascript-scene/the-forgotten-history-of-oop-88d71b9b2d9f">www.medium.com</a>)
                            </li>
                        </ul>

                        <p>
                            Basic notions to know in OOP.
                        </p>

                        <ol>
                            <li>
                                <b>Anything</b> and I mean <b>anything can be</b> an object.
                            </li>
                            <li>
                                Objects have <b>properties.</b>
                            </li>
                            <li>
                                <b>Properties</b> can be <b>attributes</b> or <b>methods</b> or even a combination.
                            </li>
                            <li>
                                <b>Variables</b> are declarations that store <i>something</i> into the computer's memory.
                            </li>
                        </ol>

                        <h5 style="margin-top: 1.5em;">Don't worry about knowing what everything means. We will get into it as we go!</h5>

                    </div>
                    <div style="width: 50%; float: right;" class="col-lg-7 text-center text-lg-start">
                        <img style="width: 150%; height: 25em;" src="../imgs/intro-to-oop.jpeg" alt="CEO of ROBLOX" />
                    </div>
                    <div style="width: 50%; float: right;" class="col-lg-7 text-center text-lg-start">
                        <img style="width: 100%; height: 25em;" src="../imgs/object-to-class.png" alt="CEO of ROBLOX" />
                    </div>
                </div>
            </div>

            <p style="width: fit-content; margin: auto; margin-top: 100em; margin-bottom: 10em;">
                To be continued...
            </p>

        <?php } ?>

    </body>
</html>