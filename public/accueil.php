<?php

declare(strict_types=1);

use Database\MyPdo;
use \html\AppWebPage;
use Entity\Movie;

$webPage = new \Html\WebPage("Films");
$webPage->appendCssUrl('/css/accueil.css');

$body =<<<HTML
<div class="header">
<h1> Films </h1>
</div>
<main>

HTML;


$movie = \Entity\Collection\MovieCollection::getAllMovie();


foreach ($movie as $ligne) {
    $id = $ligne->getId();
    $title = $ligne->getTitle();
    $title = $webPage->escapeString($title);
    $posterId = $ligne->getPosterId();
    $body .= <<<HTML
        <div class="film">
        <a href="film.php?filmId={$id}">
            <div class="poster">
            <img src ='poster.php?id={$posterId}'  alt='Image {$title}'/></div>
         <div>
            <p>{$title}</p>
        </div>
        </a>
        </div>
HTML;
}

$body.=<<<HTML
    </div>
    </main>
    <footer>
        {$webPage::getLastModififcation()}
    </footer>
HTML;

$webPage->appendContent($body);

echo ($webPage->ToHTML());