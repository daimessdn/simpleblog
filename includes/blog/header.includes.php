<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simpleblog</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <style>
        a {
            text-decoration: none;
            color: #000;
        }

        html,
        body {
            width: 100%;
            height: 100%;

            margin: 0;

            font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Paragraf */
        p {
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Heading */
        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        h3 {
            font-size: 1.17rem;
        }

        h4 {
            font-size: 1rem;
        }

        h5 {
            font-size: 0.83rem;
        }

        h6 {
            font-size: 0.67rem;
        }

        /* Link */
        a, .nav-link, .btn {
            font-size: 1rem;
            /* tambahkan properti warna jika diperlukan */
        }

        /* List */
        ul,
        ol {
            font-size: 1rem;
            /* tambahkan padding atau margin sesuai kebutuhan */
        }

        /* Span, Div, dan Elemen Lainnya */
        span,
        div,
        .custom-class {
            font-size: 1rem;
            /* tambahkan properti desain lainnya */
        }

        /* Tulisan dan Label Form */
        label,
        input,
        textarea {
            font-size: 1rem;
            /* tambahkan properti desain lainnya */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark text-light">
        <div class="container">
            <ul class="nav ms-auto">
                <li class="nav-item">
                    <?php if (isset($_SESSION["token"])): ?>
                        <a class="btn btn-primary" href="pages/auth/logout.php">Pergi ke Dashboard</a>
                    <?php else: ?>
                        <a class="nav-link text-light" href="pages/auth/login.php">Login</a>
                    <?php endif; ?>
                </li>

                <?php if (isset($_SESSION["token"])): ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="pages/auth/logout.php">Logout</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <header class="py-4">
        <div class="container">
            <h1>simpleblog</h1>
        </div>
    </header>