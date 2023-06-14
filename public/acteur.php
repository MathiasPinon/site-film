<?php

declare(strict_types=1);


use Database\MyPdo;
use html\AppWebPage;
use Entity\Movie;
use Entity\Collection\MovieCollection;
use Entity\People;

if(isset($_GET['avatarId'])&& ctype_digit($_GET['avatarId'])) {
    $idActor = (int)$_GET['avatarId'];
    $actor = \Entity\People::FindPeopleById($idActor);
    foreach ($actor as $ligne) {
        $page = new \Html\WebPage($ligne->getName());
        $page->appendCssUrl('/css/acteur.css');
        $body = <<<HTML
        <div class='header'>
            <h1>{$ligne->getName()}</h1>
            <a href="accueil.php"><button type="button">Retour au menu </button> </a>
        </div>
        <main>
        <div class="acteur">
                <div class="avatar"> <img src ='avatar.php?id={$ligne->getAvatarId()}'  alt='Image {$ligne->getName()}'/> </div>
                <div class="Name_Actor">{$ligne->getName()}</div>
                <div class="Lieu">{$ligne->getPlaceOfBirth()}</div>
                <div class="Dates">
                <div class="Naissance">{$ligne->getBirthday()}</div>
                <div class="Mort">{$ligne->getDeathday()}</div>
                </div>
                <div class="Bio">{$ligne->getBiography()}</div>
        </div>
HTML;
        $movie = \Entity\Collection\MovieCollection::getAllMovieByPeople($idActor);
        foreach ($movie as $line) {
            $idMovie = $line->getId();
            $cast = \Entity\Cast::getCastById($idMovie, $idActor);

            $role = $cast->getRole();
            $idPoster = $line->getPosterId();
            $body .= <<<HTML
            <a href="film.php?filmId={$line->getId()}"><div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$idPoster}'  alt='Image {$line->getName()}'/> </div>
                <div class="infosfilm">
                <div class="Title"> <p> {$line->getTitle()} </p></div>
                <div class="Date"> <p> {$line->getReleaseDate()} </p></div>
                </div>
                <div class="role"> <p> {$role} </p>  </div>
                </div>
            </div>
            </a>
HTML;
        }

    }
    $body .= <<<HTML
        </main>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()} </p>
        </footer>
HTML;

    $page->appendContent($body);
    echo($page->toHTML());

}