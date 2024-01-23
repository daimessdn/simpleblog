<?php

require_once("../../config/index.config.php");

require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    header("location:../auth/login.php");
}

?>

<p>ini home</p>