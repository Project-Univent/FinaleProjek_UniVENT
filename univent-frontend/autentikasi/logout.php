<?php
session_start();
session_destroy();

// optional tapi rapi
unset($_SESSION);

header("Location: login.php");
exit;
