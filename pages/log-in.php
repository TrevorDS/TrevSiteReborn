<?php
require("../SITE_CONFIG.php");
require ("../main/setup.php");

// Redirect Reinforcement
if ($LOGGED_IN === true) {
    header("Location: $DEFAULT_CALLBACK_REDIRECT");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
    </head>
    <body style="color: white; background-image: url('../imgs/sun-bg.jpg')">

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>

        <div class = "container col-xl-10 col-xxl-8 px-4 py-5">
            <div class = "row align-items-center g-5 py-5">
                <div class = "col-lg-7 text-center text-lg-start">
                    <h1 style="color: purple;" class = "display-4 fw-bold lh-1 mb-3">TrevSite: Reborn.</h1>
                    <h3 style="color: purple;">Excellence. Commitment. Perseverance.</h3>
                    <p class = "col-lg-10 fs-4">
                        A growing community of developers with mutual interest: to learn and teach other aspiring developers to code.
                    </p>
                </div>
                <div class = "col-10 mx-auto col-lg-5">
                    <form action="../main/login_auth.php" method="POST" class = "p-5 border rounded-3 bg-light" style = "color: black;">
                        <!-- Meta Data-->
                        <input type="hidden" name="CallbackPage" value="<?= $PAGES . GetPageName($pageName) . "" ?>" />
                        <h3>Log In</h3><br>
                        <?php
                        if ($loginErrorMessage !== "") {
                            echo "<p style='color: red;'>$loginErrorMessage</p>";
                            ResetError($LOG_IN_ERROR_KEY);
                        }
                        ?>
                        <div class = "form-floating mb-3">
                            <input name="username" type = "text" class = "form-control" id = "floatingInput" placeholder = "Username" minlength="1" maxlength="<?= $MAX_USERNAME_LEN ?>" required>
                            <label for = "floatingInput">Username</label>
                        </div>
                        <div class = "form-floating mb-3">
                            <input name="password" type = "password" class = "form-control" id = "floatingPassword" placeholder = "Password" minlength="1" maxlength="<?= $MAX_PASSWORD_LEN ?>" required>
                            <label for = "floatingPassword">Password</label>
                        </div>
                        <!--<div class = "checkbox mb-3">
                        <label>
                        <input type = "checkbox" value = "remember-me"> Remember me
                        </label>
                        </div>-->
                        <button class = "w-100 btn btn-lg btn-primary" type = "submit">Log In</button>
                        <hr class = "my-4">
                        <div style="text-align: center;">
                            <small class = "text-muted">
                                If you do not have an account, you can sign up here:
                                <a href="home#sign-up" id="alreadyHaveAnAccount" class = "text-muted">
                                    create a new account.
                                </a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
