<?php

require_once("../../config/index.config.php");

require_once("../../styles/dashboard.styles.php");

require_once("../../includes/dashboard/header.includes.php");
require_once("../../includes/dashboard/nav.includes.php");

if (!isset($_SESSION["token"])) {
    header("location:../auth/login.php");
}
?>
<main class="w-100 pt-2">
    <div class="container mx-auto">
        <?php
        if (isset($_GET["id"])) {
            $user_id = $_GET["id"];

            $users = $user_model->select_all(["id" => $user_id])[0];
        }

        if (isset($_POST["update_user"])) {
            $name = $_POST["name"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $role = $_POST["role"];

            $user_model->update(["id" => $user_id], [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'role' => $role,
                "updated_at" => date("Y-m-d H:i:s"),
            ]);

            header("location:users.dashboard.php");
        }
        ?>

        <h1>User</h1>

        <?php
        $update_url = $_SERVER['PHP_SELF'] . "?id=" . $user_id;
        ?>

        <form action="<?= $update_url; ?>" method="post" autocomplete="off">
            <h2>Edit user</h2>
            <div class="form-group">
                <label class="form-label" for="name">Nama</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" name="name" id="name" placeholder="Masukan name" value="<?= $users['name'] ?>" required="required" />
            </div>

            <div class="form-group">
                <label class="form-label" for="usename">Username</label>
                <input class="form-control form-control-sm" type="text" autocomplete="off" name="username" id="username" placeholder="Masukan username" value="<?= $users['username'] ?>" required="required" />
            </div>

            <div class="form-group">
                <label class="form-label" for="role">Role</label>
                <select class="form-control form-control-sm" <?php if ($users["id"] == $_SESSION["profile"]["id"]) echo 'disabled="disabled"' ?> autocomplete="off" name="role" id="role" placeholder="Pilih role" required="required">
                    <option value="">Pilih role</option>
                    <option value="1" <?php if ($users["role"] == 1) echo 'selected="selected"'; ?>>Administrator</option>
                    <option value="2" <?php if ($users["role"] == 2) echo 'selected="selected"'; ?>>Kontributor</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-control form-control-sm" type="email" autocomplete="off" name="email" id="email" placeholder="Masukan alamat email" value="<?= $users['email'] ?>" required="required" />
            </div>

            <button class="btn btn-sm btn-primary" name="update_user" type="submit">Update user</button>
            <a class="btn btn-sm btn-secondary" href="users.dashboard.php">Batal</button>
        </form>
    </div>
</main>