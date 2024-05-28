<?php
include "_dbconnect.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $thread_id = $_GET['threadid'];
    $comment_description = $_POST['commentDesc'];

    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`) VALUES ('$comment_description', '$thread_id') ";
    $result = mysqli_query($conn, $sql);
    echo "Comment Added Successfully!!";
    header('location: ../thread.php?threadid=' . $thread_id);
}
