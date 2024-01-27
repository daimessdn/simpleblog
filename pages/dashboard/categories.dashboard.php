<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    $_SESSION["message"] = "Anda harus login dulu untuk mengakses <em>dashboard</em>.";
    echo "<script>window.location.href = '../auth/login.php';</script>";
}
?>
<main class="py-3">
    <div class="container mx-auto">
        <?php
        if (isset($_POST["add_category"])) {
            $name = $_POST["name"];

            $category_model->insert([
                "name" => $name,
            ]);

            $_SESSION["message"] = "Sukses menambah kategori: <strong>$name</strong>.";
        }
        ?>

        <h1>Kategori</h1>
        <?php if (isset($_SESSION["message"])) {
            generate_message("success", $_SESSION["message"]);
            unset($_SESSION["message"]);
        } ?>
        
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        $limit = 5;

        $total_categories = $category_model->count_all();
        ?>

        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th></th>
                    <th>Kategori</th>
                    <?php if ($user_model->is_administrator($_SESSION["profile"]["id"])) : ?>
                        <th></th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php
                // view categories
                $view_categories = $category_model->select_all([], $limit, ($page - 1) * $limit);

                foreach ($view_categories as $categories) :
                ?>
                    <tr>
                        <td>
                            <?= $categories["id"] ?>
                        </td>
                        <td>
                            <?= $categories["name"] ?>
                        </td>

                        <?php if ($user_model->is_administrator($_SESSION["profile"]["id"])) : ?>
                            <td style="display: flex; gap: .5rem;">
                                <a href="categories.update.dashboard.php?id=<?= $categories['id'] ?>" class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <a href="categories.delete.dashboard.php?id=<?= $categories['id'] ?>" class="btn btn-sm btn-outline-primary">
                                    Hapus
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <nav aria-label="categories__navigation">
            <ul class="pagination pagination-sm justify-content-end">

                <li class="page-item <?= $page <= 1 ? "disabled" : "" ?>">
                    <a class="page-link" href="<?= "posts.dashboard.php?page=" . ($page - 1); ?>">
                        Previous
                    </a>
                </li>

                <?php
                $page_amount = $total_categories % $limit == 0 ?
                    intdiv($total_categories, $limit) :
                    ceil($total_categories / $limit);

                for ($i = 1; $i <= $page_amount; $i++) :
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= "categories.dashboard.php?page=" . $i; ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $page >= $page_amount ? "disabled" : "" ?>">
                    <a class="page-link" href="<?= "categories.dashboard.php?page=" . ($page <= 1 ? 2 : $page + 1); ?>">
                        Next
                    </a>
                </li>
            </ul>
        </nav>

        <?php if ($user_model->is_administrator($_SESSION["profile"]["id"])) : ?>
            <form action="categories.dashboard.php" method="post" autocomplete="off">
                <h2>Tambah Kategori</h2>
                <div class="form-group">
                    <label class="form-label" for="name">Nama Kategori</label>
                    <input class="form-control form-control-sm" type="text" autocomplete="off" name="name" id="name" placeholder="Masukan nama kategori" required="required" />
                </div>

                <button class="btn btn-sm btn-primary" name="add_category" type="submit">Tambah Kategori</button>
            </form>
        <?php endif; ?>
    </div>
</main>