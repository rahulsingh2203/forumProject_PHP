<?php
include "_dbconnect.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $id = $_GET['catid'];
    $thread_title = $_POST['threadTitle'];
    $thread_description = $_POST['threadDesc'];

    $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_category_id`, `thread_user_id`) VALUES ('$thread_title', '$thread_description', '$id', '0') ";
    $result = mysqli_query($conn, $sql);
    echo "Thread Added Successfully!!";
    header('location: ../threadList.php?catid=' . $id);
}
