<?php

declare(strict_types=1);

use Database\MyPdo;
use \html\AppWebPage;

$webPage = new AppWebPage("Accueil");

$webPage->appendContent("<div class='header'><h1>"."Films"."</h1></div><main>");

$stmt = MyPDO::getInstance()->prepare(
    <<<SQL
    SELECT title,id
    FROM movie
    ORDER BY title
SQL
);

$stmt->execute();

while (($film = $stmt->fetch()) !== false) {
    $webPage->appendContent("<a href='http://localhost:8080/public/film.php'>.<div class='film'>\n<div class='poster'>\n<img src ='../images/poster_default.png' alt='default'/>\n</div>\n<p>".$webPage->escapestring($film['title'])."</p>\n</div>\n"."</a>");
}

$webPage->appendContent("</main><footer>".$webPage->getLastModififcation()."</footer>");

echo $webPage->ToHTML();