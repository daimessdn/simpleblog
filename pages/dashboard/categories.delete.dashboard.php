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
    // get category based on id
    if (isset($_GET["id"])) {
        $category_id = $_GET["id"];

        $categories = $category_model->select_all(["id" => $category_id]);

        if (sizeof($categories) > 0) {
            $post->update(
                ["category" => $category_id,],
                ["category" => 1,],
            );
            $category_model->delete(["id" => $category_id]);
            header("location:categories.dashboard.php");
        } else {
            http_response_code(404);

            echo "Kategori tidak ditemukan";
        }
    }
    ?>
</main>