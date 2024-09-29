<?php
session_start();

// clear session
session_unset();
session_destroy();

// clear cookie
if (isset($_COOKIE['savedUser'])) {
    $lifetime = 60 * 60 * 24 * 7;
    setcookie("savedUser", "", time() - $lifetime, "/");
}

header('Location: ../index.php');
exit();
?>