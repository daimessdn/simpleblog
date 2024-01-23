<?php

session_start();

$host = "localhost";
$dbname = "simpleblog";

$username = "root";
$password = "";

// init mysql connection
$conn = new PDO(
    "mysql:host=$host;dbname=$dbname;",
    $username,
    $password
);

if ($conn == true) {
    // buat table user
    $user_table_query = "CREATE TABLE IF NOT EXISTS user(id INT NOT NULL AUTO_INCREMENT, username VARCHAR(50) NOT NULL, password VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY (id));";
    $user_table = $conn->query($user_table_query);

    $check_user_is_empty_query = "SELECT * FROM user;";
    $check_user_is_empty = $conn->query($check_user_is_empty_query);

    if ($check_user_is_empty->rowCount() <= 0) {
        $insert_admin_query = "INSERT INTO user (username, email, password) VALUES (:username, :email, :my_password);";
        $insert_admin = $conn->prepare($insert_admin_query);
        $insert_admin->execute([
            ":username" => "admin",
            ":email" => "admin@example.com",
            ":my_password" => password_hash("123", PASSWORD_DEFAULT)
        ]);
    }
}
