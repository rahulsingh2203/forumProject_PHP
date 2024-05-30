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
    <?php
    $id = $_GET['catid'];
    $sql = 'SELECT * FROM `categories` WHERE category_id = ' . $id . '';
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catName = $row['category_name'];
        $catDesc = $row['category_description'];
    }
    ?>
    <div class="container my-4 p-4 pb-2" style="background-color: #cefad0">
        <div class="header">
            <h1>Welcome to <?php echo $catName; ?> Forums!</h1>
            <p class="lead"><?php echo $catDesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each others</p>
            <ul><em>
                    <li>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate speech.</li>
                    <li>Keep it clean. Don't post anything obscene or sexually explicit.</li>
                    <li> Respect each other. Don't harass or grief anyone, impersonate people, or expose their private information.</li>
                    <li>Respect our forum.</li>
                </em>
            </ul>
        </div>
    </div>
    <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
        echo '
            <div class="container my-4 p-4 text-light">
                <h2 class="mb-4">Start a Discussion!</h2>
                <form action="partials/addingThread.php?catid=' . $id . '" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label lead">Problem Title</label>
                    <input type="text" class="form-control" id="threadTitle" name="threadTitle" aria-describedby="emailHelp" style="background-color: #cefad0">
                    <div id="emailHelp" class="form-text text-light lead">Keep your title as short and crisp as possible.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label lead">Elaborate your concern</label>
                        <textarea class="form-control" id="threadDesc" name="threadDesc" rows="3" style="background-color: #cefad0"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success lead">Submit!</button>
                </form>
            </div>
';
    } else {
        echo '
        <div class="container my-4 text-light">
            <h2 class="mb-0">Please login to start a Discussion!</h2>
        </div>
        ';
    } ?>

    <div class="container my-4 p-4 text-light">
        <h2 class="mb-4">Browse Questions:</h2>
        <?php
        $id = $_GET['catid'];
        $sql = 'SELECT * FROM `threads` WHERE thread_category_id = ' . $id . '';
        $result = mysqli_query($conn, $sql);
        $noResult = True;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = False;
            $threadId = $row['thread_id'];
            $threadName = $row['thread_title'];
            $threadDesc = $row['thread_description'];
            $threadUserId = $row['thread_user_id'];
            $threadTimeStamp = $row['timestamp'];

            $sql2 = "SELECT user_name FROM `users` WHERE user_id='$threadUserId'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2['user_name'];

            echo '
            <div class="media my-3">
            <div class="media-body">
                <h5 class="mt-0"><b><a class = "text-light" href = "thread.php?threadid=' . $threadId . '">' . $threadName . '</a></b></h5>
                <p>' . $threadDesc . '</p>
                <p><em> Posted by: ' . $user . ' at ' . $threadTimeStamp . '</em></p>
                <hr>
            </div>
        </div>
            ';
        }
        if ($noResult) {
            echo "<h2>No Threads Found...</h2>";
            echo "<h5 class = 'lead'>Be the first person to start discussion related to " . $catName . ".</h5>";
        }
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>