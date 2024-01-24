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
    if (isset($_POST["add_posts"])) {
        $title = $_POST["title"];
        $post = $_POST["content"];

        $add_posts_query = "INSERT INTO posts (title, post) VALUES (:title, :post);";
        $add_posts = $conn->prepare($add_posts_query);

        $add_posts->execute([
            ":title" => $title,
            ":post" => $post,
        ]);
        echo "sukses tambah postingan <strong>$title</strong>";
    }
    ?>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Judul</th>
                <th>Isi postingan</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // view posts
            $view_posts_query = "SELECT * FROM posts;";
            $view_posts = $conn->query($view_posts_query);

            foreach ($view_posts->fetchAll(PDO::FETCH_ASSOC) as $posts) :
            ?>
                <tr>
                    <td><?= $posts["id"] ?></td>
                    <td><?= $posts["title"] ?></td>
                    <td><?= $posts["post"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="posts.dashboard.php" method="post" autocomplete="off">
        <h2>Tulis blog</h2>
        <div class="form-group">
            <label for="title">Judul Postingan</label>
            <input type="text" autocomplete="off" name="title" id="title" placeholder="Masukan judul postingan" required="required" />
        </div>

        <div class="form-group">
            <label for="content">Isi</label>
            <textarea autocomplete="off" name="content" id="content" placeholder="Tulis blog disini" required="required" rows="5"></textarea>
        </div>

        <button class="btn" name="add_posts" type="submit">Tulis postingan</button>
    </form>
</main>