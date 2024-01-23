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
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $add_user_query = "INSERT INTO user (username, email, password) VALUES ($username, $email, $password);";
        $add_user = $conn->prepare($add_user_query);

        $add_user->execute();
        echo "sukses tambah user $username";
    }
    ?>

    <p>ini halaman user</p>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>Username</th>
                <th>Email</th>
        </thead>

        <tbody>
            <?php
            // view user
            $view_user_query = "SELECT * FROM user;";
            $view_user = $conn->query($view_user_query);

            foreach ($view_user->fetchAll(PDO::FETCH_ASSOC) as $user) :
            ?>
                <tr>
                    <td><?= $user["id"] ?></td>
                    <td><?= $user["username"] ?></td>
                    <td><?= $user["email"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="users.dashboard.php" method="post" autocomplete="off">
        <h2>Tambah user</h2>
        <div class="form-group">
            <label for="usename">Username</label>
            <input type="text" autocomplete="off" name="username" id="username" placeholder="Masukan username" required="required" />
        </div>

        <div class="form-group">
            <label for="usename">Email</label>
            <input type="email" autocomplete="off" name="email" id="email" placeholder="Masukan alamat email" required="required" />
        </div>

        <div class="form-group">
            <label for="usename">Password</label>
            <input type="password" autocomplete="off" name="password" id="password" placeholder="Masukan password" required="required" />
        </div>

        <div class="form-group">
            <label for="usename">Konfirmasi</label>
            <input type="password" autocomplete="off" name="password" id="password" placeholder="Masukan konfirmasi password" required="required" />
        </div>

        <button class="btn" name="add_user" type="submit">Tambah user</button>
    </form>
</main>