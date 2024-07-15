<?php
    include "./src/view/view.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wither</title>
        <script src="https://unpkg.com/htmx.org@2.0.1"></script>
        <link rel="stylesheet" href="./src/view/css/style.css">
    </head>
    <body>
        <header>
            <?= loadHeader() ?>
        </header>
        <main>
            <?= loadMain() ?>
        </main>
        <footer>
            <?= loadFooter() ?>
        </footer>
    </body>
</html>
