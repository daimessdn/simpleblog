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
    if (isset($_POST["add_category"])) {
        $name = $_POST["name"];

        $category_model->insert([
            "name" => $name,
        ]);

        echo "sukses tambah kategori <strong>$name</strong>";
    }
    ?>

    <h1>Kategori</h1>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Kategori</th>
                <?php if ($user->is_administrator($_SESSION["profile"]["id"])): ?>
                    <th></th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php
            // view categories
            $view_categories = $category_model->select_all();

            foreach ($view_categories as $categories):
                ?>
                <tr>
                    <td>
                        <?= $categories["id"] ?>
                    </td>
                    <td>
                        <?= $categories["name"] ?>
                    </td>

                    <?php if ($user->is_administrator($_SESSION["profile"]["id"])): ?>
                        <td style="display: flex; gap: .5rem;">
                            <a href="categories.update.dashboard.php?id=<?= $categories['id'] ?>" class="btn">
                                Edit
                            </a>

                            <a href="categories.delete.dashboard.php?id=<?= $categories['id'] ?>" class="btn btn-secondary">
                                Hapus
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($user->is_administrator($_SESSION["profile"]["id"])): ?>
        <form action="categories.dashboard.php" method="post" autocomplete="off">
            <h2>Tambah Kategori</h2>
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" autocomplete="off" name="name" id="name" placeholder="Masukan nama kategori"
                    required="required" />
            </div>

            <button class="btn" name="add_category" type="submit">Tambah Kategori</button>
        </form>
    <?php endif; ?>
</main>