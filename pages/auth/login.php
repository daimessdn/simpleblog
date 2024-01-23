<?php

require_once "../../includes/login/header.php";

require_once "../../config/index.config.php";

require_once "../../styles/login.styles.php";

?>

<?php
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $check_user_exists_query = "SELECT * FROM user WHERE username = \"" . $username . "\";";
    $check_user_exists = $conn->query($check_user_exists_query);

    if ($check_user_exists->rowCount() > 0) {
        $user_hashed_password = $check_user_exists->fetch(PDO::FETCH_ASSOC)["password"];
        $check_password_match = password_verify($password, $user_hashed_password);

        $_SESSION["token"] = hash("md5", $username);

        echo $check_password_match ? "login success" : "login failed";
        header("location:../dashboard/home.dashboard.php");
    } else {
        echo "login failed";
    }
}
?>

<main>
    <form autocomplete="off" action="login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required="required" placeholder="Masukan username" />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required="required" placeholder="Masukan password" />
        </div>

        <button class="btn" name="login" type="submit">Login</button>
    </form>
</main>