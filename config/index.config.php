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
    // buat table users
    $users_table_query = "CREATE TABLE IF NOT EXISTS users(id INT NOT NULL AUTO_INCREMENT, name VARCHAR(100) DEFAULT '', role INT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY (id));";
    $users_table = $conn->query($users_table_query);

    /*
        DOKUMENTASI ROLE

        1: administrator
        2: contributor
    */

    // buat user admin pertama
    $check_user_is_empty_query = "SELECT * FROM users;";
    $check_user_is_empty = $conn->query($check_user_is_empty_query);

    if ($check_user_is_empty->rowCount() <= 0) {
        $insert_admin_query = "INSERT INTO users (name, username, email, password, role) VALUES (:name, :username, :email, :my_password, :role);";
        $insert_admin = $conn->prepare($insert_admin_query);
        $insert_admin->execute([
            ":name" => "Ini Admin",
            ":username" => "admin",
            ":email" => "admin@example.com",
            ":my_password" => password_hash("123", PASSWORD_DEFAULT),
            ":role" => 1
        ]);
    }

    // buat table postingan
    $posts_table_query = "CREATE TABLE IF NOT EXISTS posts(id INT NOT NULL AUTO_INCREMENT, title VARCHAR(200) NOT NULL, post TEXT NOT NULL, PRIMARY KEY (id));";
    $posts_table = $conn->query($posts_table_query);

    // membuat postingan pertama
    $check_posts_is_empty_query = "SELECT * FROM posts;";
    $check_posts_is_empty = $conn->query($check_posts_is_empty_query);

    if ($check_posts_is_empty->rowCount() <= 0) {
        $insert_admin_query = "INSERT INTO posts (title, post) VALUES (:title, :post);";
        $insert_admin = $conn->prepare($insert_admin_query);
        $insert_admin->execute([
            ":title" => "Hello, world!",
            ":post" => "This is the first post.",
        ]);

        header("location:./pages/auth/login.php");
    }
}
