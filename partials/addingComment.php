<?php
/*
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    session_start();
    include "_dbconnect.php";
    $commentUserId = $_SESSION['userId'];
    $thread_id = $_GET['threadid'];
    $comment_description = $_POST['commentDesc'];
    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_user_id`) VALUES ('$comment_description', '$thread_id', '$commentUserId') ";
    $result = mysqli_query($conn, $sql);
    echo "Comment Added Successfully!!";
    header('location: ../thread.php?threadid=' . $thread_id);
}
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    session_start();
    include "_dbconnect.php";
    $commentUserId = $_POST['user_id'];
    $thread_id = $_GET['threadid'];
    $comment_description = $_POST['commentDesc'];
    
    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_user_id`) VALUES ('$comment_description', '$thread_id', '$commentUserId') ";
    $result = mysqli_query($conn, $sql);
    header('location: ../thread.php?threadid=' . $thread_id);
}
?>
*/
?>
