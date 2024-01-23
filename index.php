<?php
require_once("config/index.config.php");

include_once("includes/blog/header.includes.php");

?>

<?php
    function show_posts($conn) {
        $posts = $conn->query("SELECT * FROM posts;");

        return $posts->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<main>
    <?php foreach (show_posts($conn) as $post) : ?>
        <h1><?= $post["title"]; ?></h1>
        <p><?= $post["post"]; ?></p>

        <hr />
    <?php endforeach; ?>
</main>

<?php include_once("includes/blog/footer.includes.php"); ?>