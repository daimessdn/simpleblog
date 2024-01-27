<nav class="fixed-left fixed-top h-100 dashboard-nav navbar navbar-dark bg-dark text-light flex flex-column align-items-start justify-content-start">
    <h2 class="nav-brand p-3">simpleblog</h2>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="home.dashboard.php" class="nav-link text-light">Home</a>
        </li>

        <li class=" nav-item">
            <a href="posts.dashboard.php" class="nav-link text-light">Posts</a>
        </li>

        <?php if ($user_model->is_administrator($_SESSION["profile"]["id"])) : ?>
            <li class="nav-item">
                <a href="categories.dashboard.php" class="nav-link text-light">Categories</a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a href="users.dashboard.php" class="nav-link text-light">Users</a>
        </li>

        <li class="nav-item">
            <a href="profile.dashboard.php" class="nav-link text-light">Profile</a>
        </li>

        <li class="nav-item">
            <a href="../auth/logout.php" class="nav-link text-light">Logout</a>
        </li>
    </ul>
</nav>