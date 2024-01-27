<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    $_SESSION["message"] = "Anda harus login dulu untuk mengakses <em>dashboard</em>.";
    echo "<script>window.location.href = '../auth/login.php';</script>";
}

$profile_id = $_SESSION["profile"]["id"];
?>
<main class="py-3">
    <div class="container mx-auto w-75">
        <?php
        // get post based on id
        $user = $user_model->select_all(["id" => $profile_id])[0];

        if (isset($_POST["change_password"])) {
            $new_password = $_POST["password"];

            $user_model->update(["id" => $profile_id], [
                "password" => $new_password,
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
            echo "sukses ganti password";
            echo "<script>window.location.href = 'profile.dashboard.php';</script>";
        }
        ?>

        <h1 class="mb-4">Profil</h1>

        <form action="profile.dashboard.php" method="post" autocomplete="off">
            <h2>Ganti Kata Sandi</h2>
            <div class="form-group">
                <label class="form-label" for="name">Kata sandi baru</label>
                <input class="form-control form-control-sm" type="password" autocomplete="off" name="password" id="password" placeholder="Masukan kata sandi" required="required" />
            </div>

            <div class="form-group">
                <label class="form-label" for="confirm_password">Konfirmasi kata sandi baru</label>
                <input class="form-control form-control-sm" type="password" autocomplete="off" confirm_password="confirm_password" id="confirm_password" placeholder="Konfirmasi kata sandi" required="required" />
            </div>

            <button class="btn btn-sm btn-primary" name="change_password" type="submit">Update kategori</button>
        </form>
    </div>
</main>