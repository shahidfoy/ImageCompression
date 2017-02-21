<?php
// contect to database
$host = "localhost";
$root = "root";
$password = "";
$name = "img_compression";

$connection = mysqli_connect($host, $root, $password, $name)
  or die("Connection not working");

// 8
  $query = mysqli_query($connection, "SELECT * FROM images ORDER BY id DESC LIMIT 1");
  // echo $query;

if($query) {


  while ($result_row = mysqli_fetch_assoc($query)) {
    $id = $result_row['id'];
    // echo $id;
    $displayImage = $result_row['image'];
    $datePosted = $result_row['date'];

  }
		header("content-type: image/jpeg");
		//imagejpeg($displayImage, NULL, 80);
    echo $displayImage;
		// echo "test";
		// header("Location: showimages.php?user=$user")


} else {
  echo "Error : " . $mysqli_error($connection) . "";
}

?>
