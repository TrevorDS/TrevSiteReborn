<?php
/*
 * Written by Trevor
 * 4/16/21
 * 
 * Universal NAV Header
 * Desc: This NAV will be imported on all relevant pages and auto import the 
 * "pageName" variable, displaying the correct page meta data onto the NAV for
 * that page, respectively.
 * 
 */


/* The Navbar array. It is an array of arrays of sorts. 
  It goes in order by array and uses the META data to
  render the navbar. */
$pages = array(
    array(
        "Extension" => "php",
        "Filename" => "home",
        "Display" => "Home"
    ),
    array(
        "Extension" => "php",
        "Filename" => "get-started",
        "Display" => "Get Started"
    ),
    array(
        "Extension" => "php",
        "Filename" => "documentation",
        "Display" => "Documentation"
    ),
//    array(
//        "Extension" => "php",
//        "Filename" => "source-code",
//        "Display" => "Source Code"
//    ),
    array(
        "Extension" => "php",
        "Filename" => "community",
        "Display" => "Community"
    )
);
?>
<style>
    .UserButtonForm {
        margin: auto;
    }

    .UserButton {
        background: none!important;
        border: none;
        padding: 0!important;
        /*optional*/
        font-family: arial, sans-serif;
        /*input has OS specific font-family*/
        color: white;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <img src="../imgs/fav-icon.png" alt="Logo" style="margin-right: 0.5em;" width="25" height="25">
        <a class="navbar-brand" href="#">
            <?= $websiteName ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <?php
                // Renders the navbar from the array list. 
                foreach ($pages as $pageData) {

                    $extension = $pageData["Extension"];
                    $filename = $pageData["Filename"];
                    $displayname = $pageData["Display"];

                    $isActive = "";

                    if (GetPageName($pageName) == $filename) {
                        $isActive = "active";
                    }

                    echo '<li class="nav-item">';
                    echo '<a class="nav-link ' . $isActive
                    . '" aria-current="page" '
                    . 'href=' . $PAGES . $filename //. '.' . $extension
                    . '>' . $displayname . '</a>'
                    ;
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <?php if ($LOGGED_IN === true) { ?>
            <form class="UserButtonForm" action="../main/login_auth.php" method="POST">
                <input style="color: red;" name="LogOut" class="navbar-brand UserButton" type="submit" value="(Log Out)" />
            </form>
            
            <a class="navbar-brand UserButton" href="profile?user=<?= $USERID ?>"><?= $USERNAME ?></a>
        <?php } ?>
    </div>
</nav>