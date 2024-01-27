<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    $_SESSION["message"] = "Anda harus login dulu untuk mengakses <em>dashboard</em>.";
    echo "<script>window.location.href = '../auth/login.php';</script>";
}

?>
<main class="py-3">
    <div class="container mx-auto">
        <?php if (isset($_SESSION["message"])) {
            generate_message("success", $_SESSION["message"]);
            unset($_SESSION["message"]);
        } ?>
    <h1>Selamat datang!</h1>

    <p><?php echo $_SESSION["profile"]["name"]; ?></p>
    <p><?php echo $_SESSION["profile"]["username"]; ?></p>
    <p><?php echo $_SESSION["profile"]["email"]; ?></p>
    </div>
</main>