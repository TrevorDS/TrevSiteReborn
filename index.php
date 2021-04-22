<?php
/* 
 * Written by Trevor
 * 4/16/21
 * 
 * Desc: Redirects to the correct page on website URL load.
 * 
*/
$HOME = "pages/home";

header("Location: " . $HOME);
exit;