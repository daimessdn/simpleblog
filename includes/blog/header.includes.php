<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simpleblog</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Helvetica Neue:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <style>
        a {
            text-decoration: none;
            color: #000;
        }

        html, body {
            width: 100%;
            height: 100%;

            margin: 0;

            font-family: "Helvetica Neue", sans-serif;
            font-weight: 400;
        }
        
        header, main, footer {
            max-width: 1280px;
            margin: auto;
        }

        nav {
            display: flex;
            flex-direction: column;
            
            background-color: #000000;
            color: #fff;
        }

        nav ul {
            padding: 0;
            margin: 0;

            list-style: none;
            
            display: flex;
            flex-direction: column;
        }
        
        nav ul li a  {
            padding: 1rem;
            display: block;
            background-color: #000000;
            color: #ffffff;
        }

        nav ul li a.active  {
            color: #000000;
            background-color: #ffffff;
        }

        p {
            line-height: 1.5rem;
        }
    </style>
</head>
<body>
    <header>
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

        <h1>simpleblog</h1>
    </header>
