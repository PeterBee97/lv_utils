<?php

if(isset($argv[1])){
    $img_file = $argv[1];
}
else{
    echo("Mising image file\n");
    exit(0);
}

$size = getimagesize($img_file);
$w = $size[0];
$w16 = $w & ~0xF;
if ($w16 < $w) $w16 += 16;
$h = $size[1];
$img16 = imagecreatetruecolor($w16, $h);
imagesavealpha($img16, true);
$color = imagecolorallocatealpha($img16, 255, 255, 255, 127);
imagefill($img16, 0, 0, $color);

$img = imagecreatefrompng($img_file);
imagecopy($img16, $img, ($w16 - $w)/2 , 0 , 0 , 0, $w , $h);

imagepng($img16, "_".$img_file);
imagedestroy($img);
imagedestroy($img16);

?>
