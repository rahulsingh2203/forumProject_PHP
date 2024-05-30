<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    include "_dbconnect.php";
    $userName = $_POST['signupUserName'];
    $userEmail = $_POST['signupEmail'];
    $userPassword = $_POST['signupPassword'];
    $userConfirmPassword = $_POST['signupConfirmPassword'];

    $userName = str_replace("<", "&lt;", $userName);
    $userEmail = str_replace("<", "&lt;", $userEmail);
    $userPassword = str_replace("<", "&lt;", $userPassword);
    $userConfirmPassword = str_replace("<", "&lt;",  $userConfirmPassword);

    // Check whether user exist or not
    $existSql = "SELECT * FROM `users` WHERE user_email = '$userEmail'";
    $result = mysqli_query($conn, $existSql);
    $numRow = mysqli_num_rows($result);

    if ($numRow > 0) {
        $showError = "Email already in use";
        header('location: ../index.php?signupSuccess=False&error=' . $showError . '');
    } else {
        if ($userPassword == $userConfirmPassword) {
            $hash = password_hash($userPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$userName', '$userEmail', '$hash') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showResult = True;
                header('location: /forum/index.php?signupSuccess=True');
            }
        } else {
            $showError = "Passwords does not match!!";
            header('location: /forum/index.php?signupSuccess=False&error=' . $showError . '');
        }
    }
}
