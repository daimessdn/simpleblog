<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    header("location:../auth/login.php");
}

?>

<main>
    <h1>Selamat datang!</h1>

    <p><?php echo $_SESSION["profile"]["name"]; ?></p>
    <p><?php echo $_SESSION["profile"]["username"]; ?></p>
    <p><?php echo $_SESSION["profile"]["email"]; ?></p>
</main>