<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    $_SESSION["message"] = "Anda harus login dulu untuk mengakses <em>dashboard</em>.";
    echo "<script>window.location.href = '../auth/login.php';</script>";
}?>

<main class="py-3">
    <div class="container mx-auto">
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

            $_SESSION["message"] = "Berhasil meng-<em>update</em> kategori: <strong>$name</strong>.";
            echo "<script>window.location.href = 'categories.dashboard.php';</script>";
        }
        ?>

        <h1>Kategori</h1>

        <?php
        $update_url = $_SERVER['PHP_SELF'] . "?id=" . $category_id;
        ?>

        <form action="<?= $update_url; ?>" method="post" autocomplete="off">
            <h2>Edit Kategori</h2>
            <div class="form-group">
                <label class="form-label" for="name">Nama Kategori</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" name="name" id="name" placeholder="Masukan nama kategori" value="<?= $categories["name"]; ?>" required="required" />
            </div>

            <button class="btn btn-sm btn-primary" name="update_category" type="submit">Update kategori</button>
        </form>
    </div>
</main>