<?php
session_start();

session_unset();
session_destroy();

if (isset($_COOKIE['savedUser'])) {
    $lifetime = 60 * 60 * 24 * 7;
    setcookie("savedUser", "", time() - $lifetime, "/");
}

header('Location: ../index.php');
exit();
?>