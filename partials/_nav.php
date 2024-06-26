<?php
session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="/forum">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/forum">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu">';

        $sql = "SELECT * FROM `categories` LIMIT 5";
        $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $catid = $row['category_id'];
        
        echo '
            <li><a class="text-black dropdown-item"  href="threadList.php?catid=' . $catid . '">' . $row['category_name'] . '</a></li>';
        }
         echo '
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/forum">Explore Home for more Categories...</a></li>   
          </ul>
        </li>
      </ul>';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == True) {
  //<h6 class="text-light">'. $_SESSION['userName'] .'</h6>
  echo '
      <form class="d-flex" role="search" action="/forum/partials/_search.php">
        <input class="form-control me-2" type="search" name= "search" placeholder="Search" aria-label="Search" style="background-color: #cefad0">
        <button class="btn btn-success me-2" type="submit">Search</button>
        <a role="button" href="/forum/partials/_logout.php" class="btn btn-outline-success me-2">Logout</a>
      </form>
        ';
} else {
  echo '
  <form class="d-flex" role="search" action="/forum/partials/_search.php">
  <input class="form-control me-2" type="search" name= "search" placeholder="Search" aria-label="Search" style="background-color: #cefad0">
  <button class="btn btn-success me-2" type="submit">Search</button>
  <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
</form>
  ';
}
echo '
    </div>
  </div>
</nav>
';

include '_loginModal.php';
include '_signupModal.php';
/*
if (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "True") {
  echo '<script>alert("Account created successfully!!"); </script>';
} elseif (isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "False") {
  $error = $_GET['error'];
  echo '<script>alert("' . $error . '!!"); </script>';
} elseif (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == "True") {
  echo '<script>alert("Hello ' . $_SESSION['userName'] . '!!"); </script>';
} elseif (isset($_GET['loginSuccess']) && $_GET['loginSuccess'] == "False") {
  echo '<script>alert("Opps!! Unable to login"); </script>';
}*/
?>
