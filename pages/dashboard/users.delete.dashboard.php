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
        <?php
        // get user based on id
        if (isset($_GET["id"])) {
            $user_id = $_GET["id"];

            $user = $user_model->select_all(["id" => $user_id]);

            if (sizeof($user) > 0) {
                $name = $user[0]["name"];
                $_SESSION["message"] = "Sukses menghapus user: <strong>$name</strong>.";

                $user_model->delete(["id" => $user_id]);
                echo "<script>window.location.href = 'users.dashboard.php';</script>";
        } else {
                http_response_code(404);

                echo "User tidak ditemukan";
            }
        }
        ?>
    </div>
</main>