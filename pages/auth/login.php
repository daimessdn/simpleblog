<?php
require_once "../../config/index.config.php";
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

        echo $check_password_match ? "login success" : "login failed";
    } else {
        echo "login failed";
        header("location:../dashboard/home.dashboard.php");
    }
}

?>

<form autocomplete="off" action="login.php" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required="required" />
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required="required" />
    <button name="login" type="submit">login</button>
</form>