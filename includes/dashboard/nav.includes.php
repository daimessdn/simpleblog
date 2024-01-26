<nav class="dashboard-nav navbar navbar-dark bg-dark text-light">
    <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $splitted_url = explode("/", $current_url);
        $last_url = explode("?", end($splitted_url))[0];

    ?>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="home.dashboard.php" class="nav-link text-light <?= $last_url == "home.dashboard.php" ? "active" : "" ?>">Home</a>
        </li>
    
        <li class="nav-item">
            <a href="posts.dashboard.php" class="nav-link text-light <?= $last_url == "posts.dashboard.php" ? "active" : "" ?>">Posts</a>
        </li>

        <li class="nav-item">
            <a href="categories.dashboard.php" class="nav-link text-light <?= $last_url == "categories.dashboard.php" ? "active" : "" ?>">Categories</a>
        </li>
    
        <li class="nav-item">
            <a href="users.dashboard.php" class="nav-link text-light <?= $last_url == "users.dashboard.php" ? "active" : "" ?>">Users</a>
        </li>
    
        <li class="nav-item">
            <a href="../auth/logout.php" class="nav-link text-light">Logout</a>
        </li>
    </ul>
</nav>