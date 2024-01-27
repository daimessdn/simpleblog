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
        // get category based on id
        if (isset($_GET["id"])) {
            $category_id = $_GET["id"];

            $category = $category_model->select_all(["id" => $category_id]);

            if (sizeof($category) > 0) {
                $name = $category["name"];
                $post_model->update(
                    ["category" => $category_id,],
                    ["category" => 1,],
                );
                $category_model->delete(["id" => $category_id]);

                $_SESSION["message"] = "Berhasil menghapus kategori: <strong>$name</strong>.";
                echo "<script>window.location.href = 'posts.dashboard.php';</script>";
            } else {
                http_response_code(404);

                echo "Kategori tidak ditemukan";
            }
        }
        ?>
    </div>
</main>