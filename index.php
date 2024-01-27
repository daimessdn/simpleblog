<?php
require_once("config/index.config.php");

include_once("includes/blog/header.includes.php");

$show_posts = $post_model->select_all(["status" => 1]);
?>
<main class="py-4">
    <div class="container mx-auto">
        <?php foreach ($show_posts as $posts) : ?>
            <h1><?= $posts["title"]; ?></h1>
            <p><?= $posts["post"]; ?></p>

            <hr />
        <?php endforeach; ?>
    </div>
</main>

<?php include_once("includes/blog/footer.includes.php"); ?>