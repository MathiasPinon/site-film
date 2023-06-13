<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';
require_once "../src/HTML/AppWebPage.php";
require_once "../src/Database/MyPdo.php";

use Database\MyPdo;
use \html\AppWebPage;

$webPage = new AppWebPage("Accueil");

$webPage->appendContent("<header>Films</header><main>");

$stmt = MyPDO::getInstance()->prepare(
    <<<SQL
    SELECT title
    FROM movie
    ORDER BY title
SQL
);

$stmt->execute();

while (($film = $stmt->fetch()) !== false) {
    $webPage->appendContent("<div class='film'>\n<div class='poster'>\n<img src ='../images/poster_default.png' alt='default'/>\n</div>\n<p>".$webPage->escapestring($film['title'])."</p>\n</div>\n");
}

$webPage->appendContent("</main><footer>".$webPage->getLastModififcation()."</footer>");

echo $webPage->ToHTML();