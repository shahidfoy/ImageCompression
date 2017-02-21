<?php

$post_photo=$_FILES['file']['name'];
$post_photo_tmp=$_FILES['file']['tmp_name'];

$ext = pathinfo($post_photo, PATHINFO_EXTENSION);  // getting image extension

	if(   $ext=='png' || $ext=='PNG' ||
	$ext=='jpg' || $ext=='jpeg' ||
	$ext=='JPG' || $ext=='JPEG' ||
	$ext=='gif' || $ext=='GIF'  )  // checking image extension
{
	if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG')
	{
	$src=imagecreatefromjpeg($post_photo_tmp);
	}
	if($ext=='png' || $ext=='PNG')
	{
	$src=imagecreatefrompng($post_photo_tmp);
	}
		if($ext=='gif' || $ext=='GIF')
	{
	$src=imagecreatefromgif($post_photo_tmp);
	}

		list($width_min,$height_min)=getimagesize($post_photo_tmp); // fetching original image width and height

	$newwidth_min=350; // set compressing image width

	$newheight_min=($height_min / $width_min) * $newwidth_min; // equation for compressed image height

	$tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image

	imagecopyresampled($tmp_min, $src, 0,0,0,0,$newwidth_min, $newheight_min, $width_min, $height_min); // compressing image

	imagejpeg($tmp_min,"upload/".$post_photo,80); //copy image in folder//

 }
?>

<!----- displaying images---->
 <center>
    <div style="margin-top:150px">
		<img src="<?php echo "upload/".$post_photo; ?>" />
	</div>
 </center>
