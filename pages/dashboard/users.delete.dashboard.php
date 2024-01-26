<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    header("location:../auth/login.php");
}
?>
<main class="w-100 pt-2">
    <div class="container mx-auto">
        <?php
        // get user based on id
        if (isset($_GET["id"])) {
            $user_id = $_GET["id"];

            $users = $user_model->select_all(["id" => $user_id]);

            if (sizeof($users) > 0) {
                $user_model->delete(["id" => $user_id]);
                header("location:users.dashboard.php");
            } else {
                http_response_code(404);

                echo "user tidak ditemukan";
            }
        }
        ?>
    </div>
</main>