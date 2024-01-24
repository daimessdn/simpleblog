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
    <?php
    // get user based on id
    if (isset($_GET["id"])) {
        $user_id = $_GET["id"];

        $users = $user->select_all(["id" => $user_id]);

        if (sizeof($users) > 0) {
            $user->delete(["id" => $user_id]);
            header("location:users.dashboard.php");
        } else {
            http_response_code(404);

            echo "user tidak ditemukan";
        }
    }
    ?>
</main>