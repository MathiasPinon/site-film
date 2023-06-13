<?php
declare(strict_types=1);

use Entity\Picture;

$img = \Entity\Picture::findAvatarById((int)$_GET['id']);

header("Content-type: image/jpeg");

echo $img->getJpeg();