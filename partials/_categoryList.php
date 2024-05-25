<?php
//query to select data from categories table
$sql1 = "SELECT * FROM `categories`";

//execution of query
$result = mysqli_query($conn, $sql1);

//using while loop to iterate all data fetched using query in a structured way
echo '<div class="row">';
while ($row = mysqli_fetch_assoc($result)) {
  $desc = substr($row['category_description'], 0, 90);
  $catid = $row['category_id'];
  echo '
    <div class="col-md-3 mb-4">
    <div class="card" style="width: 18rem; background-color: #cefad0">
      <div class="card-body" >
        <h5 class="card-title"><b><a class="text-black"  href="threadList.php?catid=' . $catid . '">' . $row['category_name'] . '</a></b></h5>
        <p class="card-text">' . $desc . '...</p>
        <a href="threadList.php?catid=' . $catid . '" class="btn btn-success">View Threads</a>
      </div>
    </div>
    </div>
    ';
}
echo '</div>';



