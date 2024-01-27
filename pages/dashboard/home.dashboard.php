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
    "drafts" => $post_model->count_all(["status" => 0]),
    "categories" => $category_model->count_all(),
];
?>
<main class="py-3">
    <div class="container mx-auto w-75">
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
        </div>

        <?php if ($totals["drafts"] > 0) : ?>
            <hr />

            <h2>Lanjutkan menulis postingan.</h2>
            <p class="mb-2">Ada postingan Anda yang belum selesai ditulis. Lanjutkan menulis.</p>

            <?php
            $drafts = $post_model->select_all(["status" => 0]);

            foreach ($drafts as $draft) :
            ?>
                <div class="card border-primary mb-3">
                    <div class="card-header py-3">
                        <h2 class="card-title">
                            <?= $draft["title"]; ?>
                        </h2>

                        <p class="card-subtitle fs-6">
                            <i class="fa-solid fa-tag"></i>
                            <?= $category_model->select_all(["id" => $draft["category"]])[0]["name"]; ?>
                        </p>
                    </div>

                    <div class="card-body">
                        <p class="text-truncate m-0">
                            <?= $draft["post"]; ?>
                        </p>
                    </div>

                    <div class="card-footer py-3 flex gap-3 justify-content-end">
                        <a href="posts.update.dashboard.php?id=<?= $draft['id']; ?>" class=" btn btn-primary">Lanjutkan postingan</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>