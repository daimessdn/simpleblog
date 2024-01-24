<nav>
    <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $splitted_url = explode("/", $current_url);
        $last_url = end($splitted_url)
    ?>
    
    <ul>
        <li>
            <a href="home.dashboard.php" class=<?= $last_url == "home.dashboard.php" ? "active" : "" ?>>Home</a>
        </li>
    
        <li>
            <a href="posts.dashboard.php" class=<?= $last_url == "posts.dashboard.php" ? "active" : "" ?>>Posts</a>
        </li>
    
        <li>
            <a href="users.dashboard.php" class=<?= $last_url == "users.dashboard.php" ? "active" : "" ?>>Users</a>
        </li>
    
        <li>
            <a href="../auth/logout.php">Logout</a>
        </li>
    </ul>
</nav>