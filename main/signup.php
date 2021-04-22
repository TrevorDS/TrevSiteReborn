<?php
/*
 * Written by Trevor
 * 4/19/21
 * 
 * Universal Sign-Up Widget
 * 
 */
if (isset($_SESSION["UserDATA"])) {
    return false;
} // Don't show widget if the user is logged in
?>
<!-- Sign Up Widget -->
<style>
    #alreadyHaveAnAccountDIV {
        text-align: center;   
        margin-top: 1.5em;
        margin-bottom: 0;
    }

    #alreadyHaveAnAccount {
        text-decoration: underline;
    }
</style>
<div id="sign-up" class="<?= $SIGN_UP_ELEMENT_ID ?>">
    <div class = "container col-xl-10 col-xxl-8 px-4 py-5">
        <div class = "row align-items-center g-5 py-5">
            <div class = "col-lg-7 text-center text-lg-start">
                <h1 class = "display-4 fw-bold lh-1 mb-3">Join Today.</h1>
                <h3>It's free!</h3>
                <p class = "col-lg-10 fs-4">Totally optional, but joining us allows for TrevSite to better get to know you!Creating an account is 100% free.</p>
            </div>
            <div class = "col-10 mx-auto col-lg-5">
                <form action="../main/signup_auth.php" method="POST" class = "p-5 border rounded-3 bg-light" style = "color: black;">
                    <!-- Meta Data-->
                    <input type="hidden" name="CallbackPage" value="<?= $PAGES . GetPageName($pageName) . "" ?>" />
                    <h3>Sign Up</h3><br>
                    <?php
                    if ($signupErrorMessage !== "") {
                        echo "<p style='color: red;'>$signupErrorMessage</p>";
                        ResetError($SIGN_UP_ERROR_KEY);
                    }
                    ?>
                    <div class = "form-floating mb-3">
                        <input name="username" type = "text" class = "form-control" id = "floatingInput" placeholder = "Username" minlength="1" maxlength="<?= $MAX_USERNAME_LEN ?>" required>
                        <label for = "floatingInput">Username</label>
                    </div>
                    <div class = "form-floating mb-3">
                        <input name="email" type = "email" class = "form-control" id = "floatingEmail" placeholder = "name@example.com" minlength="1" maxlength="<?= $MAX_EMAIL_LEN ?>" required>
                        <label for = "floatingEmail">Email address</label>
                    </div>
                    <div class = "form-floating mb-3">
                        <input name="password" type = "password" class = "form-control" id = "floatingPassword" placeholder = "Password" minlength="1" maxlength="<?= $MAX_PASSWORD_LEN ?>" required>
                        <label for = "floatingPassword">Password</label>
                    </div>
                    <div class = "form-floating mb-3">
                        <input name="password2" type = "password" class = "form-control" id = "floatingPassword2" placeholder = "Re-Enter Password" minlength="1" maxlength="<?= $MAX_PASSWORD_LEN ?>" required>
                        <label for = "floatingPassword">Re-Enter Password</label>
                    </div>
                    <!--<div class = "checkbox mb-3">
                    <label>
                    <input type = "checkbox" value = "remember-me"> Remember me
                    </label>
                    </div>-->
                    <button class = "w-100 btn btn-lg btn-primary" type = "submit">Sign up</button>
                    <hr class = "my-4">
                    <small class = "text-muted">
                        By clicking Sign up, you agree to the terms of use.
                    </small>
                    <br>
                    <div id="alreadyHaveAnAccountDIV">
                        <a href="log-in" id="alreadyHaveAnAccount" class = "text-muted">
                            Already have an account.
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>