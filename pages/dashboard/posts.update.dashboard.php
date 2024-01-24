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

        $posts = $post->select_all(["id" => $post_id])[0];
    }

    if (isset($_POST["update_post"])) {
        $title = $_POST["title"];
        $category = $_POST["category"];
        $body = $_POST["content"];

        $post->update(["id" => $post_id], [
            "title" => $title,
            "category" => $category,
            "post" => $body,
            "status" => 1,
            "published_at" => $posts["status"] == 0 ? date("Y-m-d H:i:s") : null,
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        echo "sukses update postingan <strong>$title</strong>";
        
        header("location:posts.dashboard.php");
    } else if (isset($_POST["update_draft"])) {
        $title = $_POST["title"];
        $category = $_POST["category"];
        $body = $_POST["content"];

        $post->update(["id" => $post_id], [
            "title" => $title,
            "category" => $category,
            "post" => $body,
            "status" => 0,
        ]);

        echo "postingan <strong>$title</strong> disimpan sebagai draft";

        header("location:posts.dashboard.php");
    }
    ?>

    <h1>Edit Postingan</h1>

    <?php
        $update_url = $_SERVER['PHP_SELF'] . "?id=" . $post_id;
    ?>

    <form action="<?= $update_url; ?>" method="post" autocomplete="off">
        <h2>Tulis blog</h2>
        <div class="form-group">
            <label for="title">Judul Postingan</label>
            <input type="text" autocomplete="off" name="title" id="title" placeholder="Masukan judul postingan" value="<?= $posts["title"]; ?>"
                required="required" />
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <select autocomplete="off" name="category" id="category" placeholder="Pilih kategori" ="<?= $posts["category"]; ?>"
                required="required">
                <option value="">Pilih kategori</option>
                <option value="0" <?php if ($posts["category"] == 0) echo 'selected="selected"'; ?>>Belum ada kategori</option>
                <option value="1" <?php if ($posts["category"] == 1) echo 'selected="selected"'; ?>>Artikel</option>
                <option value="2" <?php if ($posts["category"] == 2) echo 'selected="selected"'; ?>>Blog</option>
                <option value="3" <?php if ($posts["category"] == 3) echo 'selected="selected"'; ?>>Berita</option>
                <option value="4" <?php if ($posts["category"] == 4) echo 'selected="selected"'; ?>>Portfolio</option>
            </select>
        </div>

        <div class="form-group">
            <label for="content">Isi</label>
            <textarea rows="5" autocomplete="off" name="content" id="content" placeholder="Tulis blog disini"
                required="required"><?= $posts["post"] ?></textarea>
        </div>

        <button class="btn" name="update_post" type="submit">Update dan publish</button>
        <button class="btn btn-secondary" name="update_draft" type="submit">Simpan sebagai draft</button>
    </form>
</main>