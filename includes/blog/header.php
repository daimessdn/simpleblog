<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simpleblog</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>simpleblog</h1>
    </header>

    <nav>
        <ul>
            <li>
                <?php if (isset($_SESSION["token"])) : ?>
                    <a href="pages/auth/logout.php">Logout</a>
                <?php else : ?>
                    <a href="pages/auth/login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>