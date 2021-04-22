<?php
require("../SITE_CONFIG.php");
require ("../main/setup.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TrevSite Reborn · Community</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <style>
            pre code {
                background-color: #eee;
                border: 1px solid #999;
                display: block;
                padding: 20px;
            }
        </style>
    </head>
    <body>

        <!--NAV Bar-->
        <?php require "../ui/nav.php"; ?>

        <div id="about-us" class="px-4 pt-5 my-5 text-center border-bottom">
            <h1 class="display-4 fw-bold">Welcome to the Community.</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Get to know other members of the community!</p>
                <hr>
                <!-- Community Members-->
                <?php
                $TABLE = "users";

                // Create connection
                $conn = new mysqli($DB_SERVER_NAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

                // Check connection
                if ($conn->connect_error) {
                    echo "No users found.";
                } else {

                    $accounts_sql = "SELECT * FROM $TABLE";
                    $accounts_result = $conn->query($accounts_sql);

                    // Account exists
                    if ($accounts_result->num_rows > 0) {

                        while ($row = $accounts_result->fetch_assoc()) {
                            
                            $profileDATA = GetProfileDataForUser($row["user_id"]);
                            
                            $C_PFP = $profileDATA["Picture"];
                            $C_BIO = $profileDATA["Bio"];
                            
                            echo "<h3>" . $row["username"] . "</h3>";
                            echo '<a href="' . $PAGES . 'profile?user=' . $row["user_id"] . '">Visit Profile</a>';
                            echo '<div class="container px-5">';
                            // TODO: use their icon
                            echo '<img src="' . $C_PFP . '" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="100" height="100" loading="lazy">';
                            echo "</div>";
                            // TODO: use their bio
                            echo '<p class="lead mb-4">' . $C_BIO . '</p>';
                            echo "<hr>";
            
                            
                        }
                        
                    } else {
                        echo "No users found.";
                    }
                }
                ?>
                </div>
        </div>

    </body>
</html>
