<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    header("location:../auth/login.php");
}?>
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
            "published_at" => $posts["status"] == 0 ? date("Y-m-d H:i:s") : $posts["published_at"],
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

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

        header("location:posts.dashboard.php");
    }
    ?>
    <h1>Postingan</h1>

    <?php
        $update_url = $_SERVER['PHP_SELF'] . "?id=" . $post_id;
    ?>

    <form action="<?= $update_url; ?>" method="post" autocomplete="off">
        <h2>Edit Blog</h2>
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

                
                <?php
                    $show_categories = $category_model->select_all();

                    foreach ($show_categories as $categories) :
                ?>
                <option value="<?= $categories['id']; ?>" <?php if ($posts["category"] == $categories['id']) echo 'selected="selected"'; ?>><?= $categories['name']; ?></option>
                <?php endforeach; ?>
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