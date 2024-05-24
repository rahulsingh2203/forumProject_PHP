<?php include "partials/_dbconnect.php"; ?>
<!doctype html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>iDiscuss - coding forums</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    
    <body style="background-color: #424242;">
        
    <!-- Navigation Bar -->
    <?php include "partials/_nav.php"; ?>

    <!-- Carousel -->
    <?php include "partials/_carousel.php"; ?>

    <!-- Categories -->
    <div class="container mt-2 mb-2">
        <h2 class="text-center pt-2 pb-2 text-light">Welcome to idiscuss - Browse Categories</h2>
        <!-- Fetching categories from DB -->
        <?php include "partials/_categoryList.php"; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>