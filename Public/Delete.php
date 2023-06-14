<?php

declare(strict_types=1);

use Database\MyPdo;
use \html\AppWebPage;
use Entity\Movie;
if(!isset($_GET['filmId'])) {
    if (isset($_GET['Genre'])) {
        $webPage = new \Html\WebPage("Delet");
        $webPage->appendCssUrl('/css/accueil.css');

        $body = <<<HTML
            <div class="header">
            <h1> Supression </h1>
            </div>
                <form name="filter" method="GET" action="accueil.php">
                <select name="Genre">
            HTML;

        $genres = \Entity\Collection\GenreCollection::getAllGenre();
        foreach ($genres as $genre) {
            $body .= <<<HTML
                    <option value="{$genre->getId()}">{$genre->getName()} </option> 
        HTML;
        }
        $body .= <<<HTML
                </select>
                <input type="submit" value="Filtrer">
                <main>
        HTML;
        $movie = \Entity\Collection\MovieCollection::getAllMovieWithFilter((int)$_GET['Genre']);


        foreach ($movie as $ligne) {
            $id = $ligne->getId();
            $title = $ligne->getTitle();
            $title = $webPage->escapeString($title);
            $posterId = $ligne->getPosterId();
            $body .= <<<HTML
                <div class="film">
                <a href="Delete.php?filmId={$id}">
                    <div class="poster">
                    <img src ='poster.php?id={$posterId}'  alt='Image {$title}'/></div>
                 <div>
                    <p>{$title}</p>
                </div>
                </a>
                </div>
        HTML;
        }

        $body .= <<<HTML
            </div>
            </main>
            <footer>
                {$webPage::getLastModififcation()}
            </footer>
        HTML;

        $webPage->appendContent($body);

        echo($webPage->ToHTML());

    } else {
        $webPage = new \Html\WebPage("Supression");
        $webPage->appendCssUrl('/css/accueil.css');

        $body = <<<HTML
        <div class="header">
        <h1> Supression </h1>
        </div>
            <form name="filter" method="GET" action="accueil.php">
            <select name="Genre">
        HTML;

        $genres = \Entity\Collection\GenreCollection::getAllGenre();
        foreach ($genres as $genre) {
            $body .= <<<HTML
                <option value="{$genre->getId()}">{$genre->getName()} </option> 
    HTML;
        }
        $body .= <<<HTML
            </select>
            <input type="submit" value="Filtrer">
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
            <a href="Delete.php?filmId={$id}">
                <div class="poster">
                <img src ='poster.php?id={$posterId}'  alt='Image {$title}'/></div>
             <div>
                <p>{$title}</p>
            </div>
            </a>
            </div>
    HTML;
        }

        $body .= <<<HTML
        </div>
        </main>
        <footer>
            {$webPage::getLastModififcation()}
        </footer>
    HTML;

        $webPage->appendContent($body);

        echo($webPage->ToHTML());
    }
}
else{
    \Entity\Movie::deleteMovie((int)$_GET['filmId']);
    $page = new \Html\WebPage("Supression");
    $body =<<<HTML
            <p> Film suprimer </p>
             <a href="accueil.php"><button type="button">Retour à la liste de film</button></a>  
HTML;
    $page->appendContent($body);
    echo($page->toHTML());
}