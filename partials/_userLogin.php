<?php
$method = $_SERVER['REQUEST_METHOD'];;
if ($method == 'POST') {
    include "_dbconnect.php";
    $loginEmail = $_POST['loginUserName'];
    $loginPassword = $_POST['loginUserPassword'];

    $sql = "SELECT * FROM `users` WHERE user_email = '$loginEmail'";
    $result = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($loginPassword, $row['user_password'])) {
            session_start();
            $_SESSION['loggedIn'] = True;
            $_SESSION['userName'] = $row['user_name'];
            $_SESSION['userId'] = $row['user_id'];
            header('location: /forum/index.php?loginSuccess=True');
        } else {
            header('location: /forum/index.php?loginSuccess=False');
        }
    }else {
        header('location: /forum/index.php?loginSuccess=False');
    }
}
