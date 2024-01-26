<?php
require_once("config/index.config.php");

include_once("includes/blog/header.includes.php");

?>
<?php
    $show_posts = $post->select_all(["status" => 1]);
?>
<main>
    <?php foreach ($show_posts as $posts) : ?>
        <h1><?= $posts["title"]; ?></h1>
        <p><?= $posts["post"]; ?></p>

        <hr />
    <?php endforeach; ?>
</main>

<?php include_once("includes/blog/footer.includes.php"); ?>