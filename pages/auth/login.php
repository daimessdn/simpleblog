<?php

require_once "../../includes/login/header.includes.php";

require_once "../../config/index.config.php";

require_once "../../styles/login.styles.php";

?>

<?php
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $is_user_exists = $user->check_user_exists($username);

    if ($is_user_exists) {
        $is_password_match = $user->verify_password($username, $password);

        if ($is_password_match) {
            $profile = $user->select_all(["username" => $username])[0];

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

<main>
    <form autocomplete="off" action="login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                name="username"
                id="username"
                required="required"
                placeholder="Masukan username"
            />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                required="required"
                placeholder="Masukan password"
            />
        </div>

        <button class="btn" name="login" type="submit">Login</button>
    </form>
</main>