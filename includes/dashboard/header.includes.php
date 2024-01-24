<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simpleblog</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        html, body {
            width: 100%;
            height: 100%;

            font-family: "Raleway", sans-serif;
            font-weight: 400;

            margin: 0;

            display: flex;
            flex-direction: row;
        }

        nav {
            display: flex;
            flex-direction: column;

            width: 20%;
            height: 100svh;

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

        main {
            min-width: 60%;
            
            margin: 0 auto;
        }

        p {
            margin-top: 0;
        }
    </style>
</head>
<body>