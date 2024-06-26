<!-- Establishing connection -->

<?php
include "partials/_dbconnect.php";
?>

<?php
//insert comment into DB

$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $commentUserId = $_POST['user_id'];
    $thread_id = $_GET['threadid'];
    $comment_description = $_POST['commentDesc'];
    $comment_description = str_replace("<", "&lt;", $comment_description); //prone to xss attack
    $comment_description = str_replace(">", "&gt;", $comment_description); //prone to xss atack

    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_user_id`) VALUES ('$comment_description', '$thread_id', '$commentUserId') ";
    $result = mysqli_query($conn, $sql);
}
?>

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

    <!-- Fetching single Thread data -->

    <?php
    $threadId = $_GET['threadid'];
    $sql = 'SELECT * FROM `threads` WHERE thread_id = ' . $threadId . '';
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $threadName = $row['thread_title'];
        $threadDesc = $row['thread_description'];
        $questionBy = $row['thread_user_id'];

        $sql2 = "SELECT user_name FROM `users` WHERE user_id='$questionBy'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $postedBy = $row2['user_name'];
    }
    ?>

    <!-- Display single Thread data -->

    <div class="container my-4 p-4 pb-2" style="background-color: #cefad0">
        <div class="header">
            <h1><?php echo $threadName; ?></h1>
            <p class="lead"><?php echo $threadDesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each others</p>
            <ul><em>
                    <li>Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or hate speech.</li>
                    <li>Keep it clean. Don't post anything obscene or sexually explicit.</li>
                    <li> Respect each other. Don't harass or grief anyone, impersonate people, or expose their private information.</li>
                    <li>Respect our forum.</li>
                </em>
            </ul>
            <p class="lead"><b>Question posted by: <?php echo $postedBy; ?></b></p>
        </div>
    </div>

    <!-- Form to log comment(only when loggedin) -->

    <?php
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
        $user_id = $_SESSION['userId'];
        echo '
            <div class="container my-4 p-4 text-light">
                <h2 class="mb-4">Write your comment!</h2>
                <form action= "' . $_SERVER['REQUEST_URI'] . '" method="post">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label lead">Write your comment in the below text area:</label>
                        <textarea class="form-control" id="commentDesc" name="commentDesc" rows="3" style="background-color: #cefad0"></textarea>
                        <input type="hidden" name="user_id" value ="' . $user_id . '" >
                    </div>
                    <button type="submit" class="btn btn-success lead">Post Comment!</button>
                </form>
            </div>
    ';
    } else {
        echo '
                <div class="container my-4 text-light">
                    <h2 class="mb-0">Please login write a comment!</h2>
                </div>
            ';
    }
    ?>

    <!-- Fetching comments related to fetched thread -->

    <div class="container my-4 p-4 text-light">
        <h2 class="mb-4">Discussions:</h2>
        <?php
        $noResult = True;
        $id = $_GET['threadid'];
        $sql = 'SELECT * FROM `comments` WHERE thread_id = ' . $id . '';
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = False;
            $commentUser = $row['comment_user_id'];
            $commentDesc = $row['comment_content'];
            $commentTime = $row['comment_time'];

            $sql2 = "SELECT user_name FROM `users` WHERE user_id='$commentUser'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2['user_name'];

            echo '
                    <div class="media my-3">
                        <div class="media-body">
                            <p>' . $commentDesc . ' </p>
                            <p><em">Posted by ' . $user . ' at ' . $commentTime . '</em>
                            <hr>
                        </div>
                    </div>
                ';
        }
        if ($noResult) {
            echo "<h2>No Threads Found...</h2>";
            echo "<h5 class='lead'>Be the first person to write comment related to this discussion.</h5>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>