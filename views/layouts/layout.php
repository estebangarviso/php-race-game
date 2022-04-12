<?php

use App\Core\Application;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@0;1&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title><?php echo APP_NAME ?></title>
</head>

<body>
    <header>
        <?php include_once Application::$ROOT_DIR . "/views/partials/header.php"; ?>
    </header>
    <main>
        <div class="main-container">
            {{content}}
        </div>
    </main>
    <footer>
        <?php include_once Application::$ROOT_DIR . "/views/partials/footer.php"; ?>
    </footer>
    <!-- Bundle JS -->
    <script src="assets/bundle.js"></script>
</body>

</html>