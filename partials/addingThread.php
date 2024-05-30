<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    session_start();
    include "_dbconnect.php";
    $threadUserId = $_SESSION['userId'];
    $id = $_GET['catid'];
    $thread_title = $_POST['threadTitle'];
    $thread_title = str_replace("<", "&lt;", $thread_title); //prone to xss attack
    $thread_title = str_replace(">", "&gt;", $thread_title); //prone to xss atack
    $thread_description = $_POST['threadDesc'];
    $thread_description = str_replace("<", "&lt;", $thread_description); //prone to xss attack
    $thread_description = str_replace(">", "&gt;", $thread_description); //prone to xss atack

    $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_description', '$id', '$threadUserId') ";
    $result = mysqli_query($conn, $sql);
    echo "Thread Added Successfully!!";
    header('location: ../threadList.php?catid=' . $id);
}
