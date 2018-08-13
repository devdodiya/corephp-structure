<?php
// created compressed JPEG file from source file
function compressImage($source_image, $compress_image) {
	$image_info = getimagesize($source_image);
	if ($image_info['mime'] == 'image/jpeg') {
		$source_image = imagecreatefromjpeg($source_image);
		imagejpeg($source_image, $compress_image, 75);
	} elseif ($image_info['mime'] == 'image/gif') {
		$source_image = imagecreatefromgif($source_image);
		imagegif($source_image, $compress_image, 75);
	} elseif ($image_info['mime'] == 'image/png') {
		$source_image = imagecreatefrompng($source_image);
		imagepng($source_image, $compress_image, 6);
	}
	return $compress_image;
}

//To get Current Directory
function getCurrentDirectory() {
	$path = dirname($_SERVER['PHP_SELF']);
	$position = strrpos($path,'/') + 1;
	return substr($path,$position);
}

//to check url exists same as file exists but with more accuracy for images and files 
function UR_exists($url){
	$headers=get_headers($url);
	return stripos($headers[0],"200 OK")?true:false;
}
// to print limited character of strings
function shortTitle($str,$num){
	if(strlen($str) > $num){
		$shortStr = substr($str, 0, $num)."...";
	}else{
		$shortStr = $str;
	}
	echo $shortStr;
}
// to lload default variable for page

function loadVariable($var,$default) {
	if (isset($_POST[$var])) {
		return $_POST[$var];
	} elseif (isset($_GET[$var])) {
		return $_GET[$var];
	} else {
		return $default;
	}
}

?>



