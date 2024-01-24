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

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // view user
            $view_users = $user->select_all();

            foreach ($view_users as $user):
                ?>
                <tr>
                    <td>
                        <?= $user["id"] ?>
                    </td>
                    <td>
                        <?= $user["name"] ?>
                    </td>
                    <td>
                        <?= $user["username"] ?>
                    </td>
                    <td>
                        <?= $user["email"] ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="users.dashboard.php" method="post" autocomplete="off">
        <h2>Tambah user</h2>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" autocomplete="off" name="name" id="name" placeholder="Masukan name"
                required="required" />
        </div>

        <div class="form-group">
            <label for="usename">Username</label>
            <input type="text" autocomplete="off" name="username" id="username" placeholder="Masukan username"
                required="required" />
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select autocomplete="off" name="role" id="role" placeholder="Pilih role" required="required">
                <option value="">Pilih role</option>
                <option value="1">Administrator</option>
                <option value="2">Kontributor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" autocomplete="off" name="email" id="email" placeholder="Masukan alamat email"
                required="required" />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" autocomplete="off" name="password" id="password" placeholder="Masukan password"
                required="required" />
        </div>

        <div class="form-group">
            <label for="password_confirm">Konfirmasi</label>
            <input type="password" autocomplete="off" name="password_confirm" id="password_confirm"
                placeholder="Masukan konfirmasi password" required="required" />
        </div>

        <button class="btn" name="add_user" type="submit">Tambah user</button>
    </form>
</main>