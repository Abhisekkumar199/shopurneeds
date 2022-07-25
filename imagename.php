<?php

$directory = 'bulkproductimageupload';
$gallery = scandir($directory);
$gallery = preg_grep ('/\.jpg$/i', $gallery);
// print_r($gallery);

foreach ($gallery as $k2 => $v2) {
    if (exif_imagetype($directory."/".$v2) == IMAGETYPE_JPEG) {
        rename($directory.'/'.$v2, $directory.'/'.str_replace("#","",$v2));
    }
}
?>