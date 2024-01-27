<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    $_SESSION["message"] = "Anda harus login dulu untuk mengakses <em>dashboard</em>.";
    echo "<script>window.location.href = '../auth/login.php';</script>";
}

$totals = [
    "users" => $user_model->count_all(),
    "posts" => $post_model->count_all(),
    "published_posts" => $post_model->count_all(["status" => 1]),
    "categories" => $category_model->count_all(),
];
?>
<main class="py-3">
    <div class="container mx-auto">
        <?php if (isset($_SESSION["message"])) {
            generate_message("success", $_SESSION["message"]);
            unset($_SESSION["message"]);
        } ?>

        <h1 class="mb-4">Dashboard</h1>

        <div class="row row-cols-2">
            <div class="col">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h2>
                            <i class="fa-solid fa-users"></i> Kelola User
                        </h2>

                        <p class="mb-0">
                            Terdapat <?= strval($totals["users"]) ?> user yang
                            dibuat dengan <em>role</em> administrator dan kontributor.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h2>
                            <i class="fa-solid fa-pencil"></i> Kelola postingan
                        </h2>

                        <p class="mb-0">
                            Terdapat <?= strval($totals["posts"]) ?> postingan yang dibuat.
                            Adapun <?= strval($totals["published_posts"]) ?> postingan
                            telah dipublikasikan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h2>
                            <i class="fa-solid fa-tag"></i> Kelola kategori
                        </h2>

                        <p class="mb-0">
                            Terdapat <?= strval($totals["categories"]) ?> kategori yang dibuat.
                        </p>
                    </div>
                </div>
            </div>
</main>