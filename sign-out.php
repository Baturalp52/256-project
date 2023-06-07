<?php
session_start();

setcookie(session_name(), "", 1, "/");

session_destroy();
header("Location: register");
exit;
?>