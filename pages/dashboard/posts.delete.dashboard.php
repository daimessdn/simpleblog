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
    <div class="container mx-auto w-75">
        <?php
        // get post based on id
        if (isset($_GET["id"])) {
            $post_id = $_GET["id"];

            $post = $post_model->select_all(["id" => $post_id]);

            if (sizeof($post) > 0) {
                $title = $post[0]["title"];
                $post_model->delete(["id" => $post_id]);
                $_SESSION["message"] = "Berhasil menghapus postingan: <strong>$title</strong>.";
                echo "<script>window.location.href = 'posts.dashboard.php';</script>";
            } else {
                http_response_code(404);

                echo "Postingan tidak ditemukan";
            }
        }
        ?>
    </div>
</main>