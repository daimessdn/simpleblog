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
        $category_id = $_GET["id"];

        $categories = $category_model->select_all(["id" => $category_id])[0];
    }

    if (isset($_POST["update_category"])) {
        $name = $_POST["name"];

        $category_model->update(["id" => $category_id], [
            "name" => $name,
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        header("location:categories.dashboard.php");
    }
    ?>

    <h1>Kategori</h1>

    <?php
        $update_url = $_SERVER['PHP_SELF'] . "?id=" . $category_id;
    ?>

    <form action="<?= $update_url; ?>" method="post" autocomplete="off">
        <h2>Edit Kategori</h2>
        <div class="form-group">
            <label for="name">Nama Kategoori</label>
            <input type="text" autocomplete="off" name="name" id="name" placeholder="Masukan nama kategoori" value="<?= $categories["name"]; ?>"
                required="required" />
        </div>

        <button class="btn" name="update_category" type="submit">Update kategori</button>
    </form>
</main>