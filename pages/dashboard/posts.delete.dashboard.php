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
    // get post based on id
    if (isset($_GET["id"])) {
        $post_id = $_GET["id"];

        $posts = $post->select_all(["id" => $post_id]);

        if (sizeof($posts) > 0) {
            $post->delete(["id" => $post_id]);
            header("location:posts.dashboard.php");
        } else {
            http_response_code(404);

            echo "Postingan tidak ditemukan";
        }
    }
    ?>
</main>