<?php

declare(strict_types=1);


use Database\MyPdo;
use html\AppWebPage;
use Entity\Movie;
use Entity\Collection\PeopleCollection;



if(isset($_GET['filmId'])&& ctype_digit($_GET['filmId'])) {
    $idMovie = (int)$_GET['filmId'];
    $movie = \Entity\Movie::FindMovieById($idMovie);
    foreach ($movie as $ligne) {
        $page = new \Html\WebPage("film");
        $body = <<<HTML
        <main>
            <h1>{$ligne->getTitle()}</h1>
        </main>
        <content>
        <div class="film">
            <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
            <div class="titre"> <p>{$ligne->getTitle()} </div>
            <div class="date"> <p>{$ligne->getReleaseDate()} </div>
            <div class="OriginalTitle"> <p>{$ligne->getOriginalTitle()} </div>
            <div class="Slogan"> <p>{$ligne->getOverview()} </div>
            <div class="tagline"> <div>{$ligne->getTagline()} </div>
        </div>      
HTML;
        $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
        foreach ($people as $line) {
            $idPeople = $line->getId();
            $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

            $role = $cast->getRole();
            $idAvatar = $line->getAvatarId();
            $body .= <<<HTML
            <div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                <div class="role"> <p> {$role} </p>  </div>
                <div class="Name_Actor"> <p> {$line->getName()} </p></div>
            </div>
HTML;
        }

    }
    $body .= <<<HTML
        </content>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()}
        </footer>
HTML;

    $page->appendContent($body);
    echo($page->toHTML());

}
