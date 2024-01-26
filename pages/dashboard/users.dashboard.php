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
    if (isset($_POST["add_user"])) {
        $name = $_POST["name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        $user->insert([
            'name' => $name,
            'role' => $role,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        echo "sukses tambah user $username";
    }
    ?>

    <h1>User</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <?php if ($user->is_administrator($_SESSION["profile"]["id"])) : ?>
                <th></th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php
            // view user
            $view_users = $user->select_all();

            foreach ($view_users as $users):
                ?>
                <tr>
                    <td>
                        <?= $users["id"] ?>
                    </td>
                    <td>
                        <?= $users["name"] ?>
                    </td>
                    <td>
                        <?= $users["username"] ?>
                    </td>
                    <td>
                        <?= $users["email"] ?>
                    </td>
                    <td>
                        <?= $users["role"] == 1 ? "Administrator" : "Kontributor" ?>
                    </td>

                    <?php if ($user->is_administrator($_SESSION["profile"]["id"])) : ?>
                    <td style="display: flex; gap: .5rem;">
                        <a href="users.update.dashboard.php?id=<?= $users['id'] ?>" class="btn btn-sm btn-primary">
                            Edit
                        </a>

                        <?php if ($users["id"] != $_SESSION["profile"]["id"]) : ?>
                        <a href="users.delete.dashboard.php?id=<?= $users['id'] ?>" class="btn btn-sm btn-outline-primary">
                            Hapus
                        </a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($user->is_administrator($_SESSION["profile"]["id"])) : ?>
        <form action="users.dashboard.php" method="post" autocomplete="off">
            <h2>Tambah user</h2>
            <div class="form-group">
                <label class="form-label"  for="name">Nama</label>
                <input class="form-control" type="text" autocomplete="off" name="name" id="name" placeholder="Masukan name"
                    required="required" />
            </div>

            <div class="form-group">
                <label class="form-label"  for="usename">Username</label>
                <input class="form-control" type="text" autocomplete="off" name="username" id="username" placeholder="Masukan username"
                    required="required" />
            </div>

            <div class="form-group">
                <label class="form-label"  for="role">Role</label>
                <select class="form-control" autocomplete="off" name="role" id="role" placeholder="Pilih role" required="required">
                    <option value="">Pilih role</option>
                    <option value="1">Administrator</option>
                    <option value="2">Kontributor</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label"  for="email">Email</label>
                <input class="form-control" type="email" autocomplete="off" name="email" id="email" placeholder="Masukan alamat email"
                    required="required" />
            </div>

            <div class="form-group">
                <label class="form-label"  for="password">Password</label>
                <input class="form-control" type="password" autocomplete="off" name="password" id="password" placeholder="Masukan password"
                    required="required" />
            </div>

            <div class="form-group">
                <label class="form-label"  for="password_confirm">Konfirmasi</label>
                <input class="form-control" type="password" autocomplete="off" name="password_confirm" id="password_confirm"
                    placeholder="Masukan konfirmasi password" required="required" />
            </div>

            <button class="btn btn-primary" name="add_user" type="submit">Tambah user</button>
        </form>
    <?php endif; ?>
    </div>
</main>