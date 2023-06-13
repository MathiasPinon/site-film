<?php

declare(strict_types=1);

use Database\MyPdo;
use html\AppWebPage;
use Entity\Movie;
use Entity\Collection\PeopleCollection;

$webPage = new AppWebPage();
$film = new Movie();
$id = $film->getId();

$webPage->appendContent("<header>".$film->getTitle()."</header><main>");

$webPage->appendContent("<div class='film'>
                                    <img src='../images/poster_default.png' alt='poster'/>
                                    <div class='titre'>".$film->getTitle()."</div>".
                                   "<div class='date'>".$film->getReleaseDate()."</div>".
                                   "<div class='titreOriginal'>".$film->getOriginalTitle()."</div>".
                                   "<div class='slogan'>".$film->getTagline()."</div>".
                                   "<div class='resume'>".$film->getId()."</div></div>");

$webPage->appendContent("</main><footer>".$webPage->getLastModififcation()."</footer>");

echo $webPage->ToHTML();

