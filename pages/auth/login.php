<?php
require_once "../../config/index.config.php";

require_once "../../includes/login/header.includes.php";

require_once "../../styles/login.styles.php";

if (isset($_SESSION["token"])) {
    header("location:../dashboard/home.dashboard.php");
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $is_user_exists = $user_model->check_user_exists($username);

    if ($is_user_exists) {
        $is_password_match = $user_model->verify_password($username, $password);

        if ($is_password_match) {
            $profile = $user_model->select_all(["username" => $username])[0];

            $_SESSION["token"] = hash("md5", $username);
            $_SESSION["profile"] = [
                "id" => $profile["id"],
                "name" => $profile["name"],
                "email" => $profile["email"],
                "username" => $profile["username"],
            ];

            header("location:../dashboard/home.dashboard.php");
        }
    } else {
        echo "login failed";
    }
}
?>

<main class="w-100 pt-2">
    <div class="container mx-auto">
        <form autocomplete="off" action="login.php" method="post">
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" id="username" required="required" placeholder="Masukan username" />
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" required="required" placeholder="Masukan password" />
            </div>

            <button class="btn btn-primary" name="login" type="submit">Login</button>
        </form>
    </div>
</main>