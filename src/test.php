<?php
declare(strict_types=1);


use Database\MyPdo;
use Entity\Movie;

$tab = \Entity\Picture::FindById(7373);

foreach($tab as $ligne){
    echo($ligne->getJpeg());
}