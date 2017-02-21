<?php
// contect to database
$host = "localhost";
$root = "root";
$password = "";
$name = "img_compression";

$connection = mysqli_connect($host, $root, $password, $name)
  or die("Connection not working");


// image compression
$post_photo = $_FILES['file']['name'];
$post_photo_tmp = $_FILES['file']['tmp_name'];

echo $post_photo . "<br>";
echo $post_photo_tmp . "<br>";

// gets image extension
$extension = pathinfo($post_photo, PATHINFO_EXTENSION);
echo "This image extension is " . $extension . "<br>";

if($extension == "png" || $extension == "PNG" || $extension == "jpg" || $extension == "jpeg" || $extension == "JPG" || $extension == "JPEG" || $extension == "gif" || $extension == "GIF") {
  switch($extension) {
    case "png":
    case "PNG":
      $imageSource = imagecreatefrompng($post_photo_tmp);
      echo $imageSource;
      break;
    case "jpg":
    case "JPEG":
    case "JPG":
    case "jpeg":
      $imageSource = imagecreatefromjpeg($post_photo_tmp);
      echo $imageSource;
      break;
    case "gif":
    case "GIF":
      $imageSource = imagecreatefromgif($post_photo_tmp);
      echo $imageSource;
      break;
  }

// gets original image width and height
  list($width_min, $height_min) = getimagesize($post_photo_tmp);

  $newwidth_min = 400;

  $newheight_min = ($height_min / $width_min) * $newwidth_min;
  // create frame for compressed image
  $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min);

  // compresses image /////
  $compressedImage = imagecopyresampled($tmp_min, $imageSource, 0,0,0,0, $newwidth_min, $newheight_min, $width_min, $height_min);

  //copy image in folder//
  $imageFile = imagejpeg($tmp_min, "uploads/".$post_photo, 80);

  $date = date("Y-m-d");

  // grab resized image in file
  $out_image = addslashes(file_get_contents("uploads/".$post_photo));

  // submit photo into database
  $query = mysqli_query($connection, "INSERT INTO images VALUES ('', '$out_image', '$date')");

  if($query) {

  }
  else {
    echo "<br> Error image not submitted: " . mysqli_error($connection) . "<br>";
  }

/*
  $query = mysqli_query($connection, "SELECT * FROM images");

  while ($result_row = mysqli_fetch_assoc($query)) {
    $id = $result_row['id'];
    $displayImage = $result_row['image'];
    $datePosted = $result_row['date'];


    echo '
    <center>
      <div style="">
        <img src="'. $displayImage.'" />
     </div>
    </center>
    ';


    echo $displayImage;

  }
  */

}



 ?>


 <center>
   <div style="margin-top: 150px">
     <img src="showimage.php" />
  </div>
 </center>
