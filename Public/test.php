<?php
declare(strict_types=1);


use Database\MyPdo;
use Entity\Movie;


$page = new \Html\WebPage("test");

$body =<<<HTML
<h1> test </h1>
<div> 
HTML;

$movie = \Entity\Collection\MovieCollection::getAllMovie();

foreach($movie as $ligne){
    $id = $ligne->getId();
    $idPoster = $ligne->getPosterId();
    $img = \Entity\Picture::FindById($idPoster);
    $title = Movie::FindById($id);
    $body .=<<<HTML
 <div> 
 <img src="{$img}">
 <p> {$title} </p>
 </div>
 HTML;

}

$body .= "</div>";

$page->appendContent($body);

echo($page->toHTML());

