<?php include "_dbconnect.php"; ?>
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
    <?php include "_nav.php"; ?>

    <!-- Search results -->
    <?php
    $search = $_GET['search'];
    ?>
    <div class="container mt-4 my-4 p-4 pb-2" style="background-color: #cefad0; min-height: 80vh">
        <h1>Search related to <em>"<?php echo $search; ?>"</em></h1>
        <div class="container results mt-4 my-4 p-4 pb-2">

            <?php
            $search = $_GET['search'];
            //echo $search;
            //$sql = "ALTER TABLE threads ADD FULLTEXT(`thread_title`,`thread_description`);";
            $sql = "SELECT * FROM threads WHERE MATCH (thread_title, thread_description) AGAINST ('$search');";
            $result = mysqli_query($conn, $sql);
            $noResult = True;

            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = False;
                $title = $row['thread_title'];
                $desc = $row['thread_description'];
                $threadId= $row['thread_id'];

                echo '
        <h3><a class="text-black dropdown-item" href = "/forum/thread.php?threadid=' . $threadId . '">' . $title . '</a></h3>
            <p>' . $desc . '</p>
            <hr>
        ';
            }if ($noResult) {
                echo "<h3 class='text-center'>No Result Found...</h3>";
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>