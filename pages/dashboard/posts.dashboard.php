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
        $category = $_POST["category"];
        $body = $_POST["content"];

        $post->insert([
            "title" => $title,
            "category" => $category,
            "post" => $body,
            "status" => 1,
            "published_at" => date("Y-m-d H:i:s"),
        ]);

        echo "sukses tambah postingan <strong>$title</strong>";
    } else if (isset($_POST["add_draft"])) {
        $title = $_POST["title"];
        $category = $_POST["category"];
        $body = $_POST["content"];

        $post->insert([
            "title" => $title,
            "category" => $category,
            "post" => $body,
            "status" => 0,
        ]);

        echo "postingan <strong>$title</strong> disimpan sebagai draft";
    }
    ?>

    <h1>Postingan</h1>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Judul</th>
                <th>Kategori</th>
                <th></th>
                <th>Isi postingan</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            // view posts
            $view_posts = $post->select_all();
            
            foreach ($view_posts as $posts):
                $post_category = $category_model->select_all(["id" => $posts["category"]])[0]["name"];
                ?>
                <tr>
                    <td>
                        <?= $posts["id"]; ?>
                    </td>
                    <td>
                        <?= $posts["title"]; ?>
                    </td>
                    <td>
                        <?= $post_category; ?>
                    </td>
                    <td>
                        <?= $posts["status"] == 0 ? "<em>Draft</em>" : ""; ?>
                    </td>
                    <td>
                        <?= $posts["post"]; ?>
                    </td>
                    
                    <td style="display: flex; gap: .5rem;">
                        <a href="posts.update.dashboard.php?id=<?= $posts['id'] ?>" class="btn">
                            Edit
                        </a>

                        <a href="posts.delete.dashboard.php?id=<?= $posts['id'] ?>" class="btn btn-secondary">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="posts.dashboard.php" method="post" autocomplete="off">
        <h2>Tulis blog</h2>
        <div class="form-group">
            <label for="title">Judul Postingan</label>
            <input type="text" autocomplete="off" name="title" id="title" placeholder="Masukan judul postingan"
                required="required" />
        </div>

        <div class="form-group">
            <label for="category">Kategori</label>
            <select autocomplete="off" name="category" id="category" placeholder="Pilih kategori"
                required="required">
                <option value="">Pilih kategori</option>

                <?php
                    $show_categories = $category_model->select_all();

                    foreach ($show_categories as $categories) :
                ?>
                <option value="<?= $categories['id']; ?>"><?= $categories['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="content">Isi</label>
            <textarea rows="5" autocomplete="off" name="content" id="content" placeholder="Tulis blog disini"
                required="required"></textarea>
        </div>

        <button class="btn" name="add_posts" type="submit">Tulis postingan</button>
        <button class="btn btn-secondary" name="add_draft" type="submit">Simpan sebagai draft</button>
    </form>
</main>