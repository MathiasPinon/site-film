<?php
declare(strict_types=1);


use Database\MyPdo;
use html\AppWebPage;
use Entity\Movie;
use Entity\Collection\PeopleCollection;

 if (isset($_GET['filmId']) && ctype_digit($_GET['filmId'])) {
     $idMovie = (int)$_GET['filmId'];
     $movie = \Entity\Movie::FindMovieById($idMovie);
        foreach ($movie as $ligne) {
            $page = new \Html\WebPage($ligne->getTitle());
            $page->appendCssUrl('/css/film.css');
            $body = <<<HTML
        <div class='header'>
            <h1>{$ligne->getTitle()}</h1>
            <a href="accueil.php"><button type="button">Retour au menu </button> </a>
        </div>
        <main>
        <div class="film">
            <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
            <div class="infosfilm">
            <div class="ligne1">
            <a href="Update.php?upd=Tit&Film={$idMovie}"><div class="titre"> {$ligne->getTitle()}</div>
            <a href="Update.php?upd=Date&Film={$idMovie}"> <div class="date"> {$ligne->getReleaseDate()}</div> </a>
            </div>
           <a href="Update.php?upd=Title&Film={$idMovie}"> <div class="OriginalTitle">Titre original : {$ligne->getOriginalTitle()}</div> </a>
            <a href="Update.php?upd=Slogan&Film={$idMovie}"><div class="Slogan">{$ligne->getTagline()}</div> </a>
            <a href="Update.php?upd=Resume&Film={$idMovie}"><div class="Resume">{$ligne->getOverview()}</div> </a>
            </div>
        </div>     
HTML;
            $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
            foreach ($people as $line) {
                $idPeople = $line->getId();
                $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

                $role = $cast->getRole();
                $idAvatar = $line->getAvatarId();
                $body .= <<<HTML
            <a href="acteur.php?avatarId={$line->getId()}"><div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                <div class="infosacteur">
                <div class="role"> <p> {$role} </p>  </div>
                <div class="Name_Actor"> <p> {$line->getName()} </p></div>
                </div>
            </div>
            </a>
HTML;
            }

        }
        $body .= <<<HTML
        </main>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()}
        </footer>
HTML;

        $page->appendContent($body);
        echo($page->toHTML());

    }

 else {
     if (isset($_GET['upd'])) {
         $moviees = Movie::FindMovieById((int)$_GET['Film']);
         if ($_GET['upd'] === "Date") {
             if (!isset($_GET['date'])) {
                 $idMovie = (int)$_GET['Film'];
                 $movie = \Entity\Movie::FindMovieById($idMovie);
                 foreach ($movie as $ligne) {
                     $page = new \Html\WebPage($ligne->getTitle());
                     $page->appendCssUrl('/css/film.css');
                     $body = <<<HTML
        <div class='header'>
            <h1>{$ligne->getTitle()}</h1>
            <a href="accueil.php"><button type="button">Retour au menu </button> </a>
        </div>
        <main>
        <div class="film">
            <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
            <div class="infosfilm">
            <div class="ligne1">
            <div class="titre"> {$ligne->getTitle()}</div>
            <div class="date"> <form action="Update.php" method="GET"> <input type="text" name="date" placeholder="{$ligne->getReleaseDate()}"></div>
            </div>
            <div class="OriginalTitle">Titre original : {$ligne->getOriginalTitle()}</div> 
            <div class="Slogan">{$ligne->getTagline()}</div>
            <div class="Resume">{$ligne->getOverview()}</div>
            </div>
        </div>     
HTML;
                     $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
                     foreach ($people as $line) {
                         $idPeople = $line->getId();
                         $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

                         $role = $cast->getRole();
                         $idAvatar = $line->getAvatarId();
                         $body .= <<<HTML
            <a href="acteur.php?avatarId={$line->getId()}"><div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                <div class="infosacteur">
                <div class="role"> <p> {$role} </p>  </div>
                <div class="Name_Actor"> <p> {$line->getName()} </p></div>
                </div>
            </div>
            </a>
HTML;
                     }

                 }
                 $body .= <<<HTML
        </main>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()}
        </footer>
HTML;

                 $page->appendContent($body);
                 echo($page->toHTML());
             } else {
                $date = "releaseDate";
                 foreach($moviees as $movies){
                     $movies->UpdateMovies($date,$_GET['date']);
                 }

             }
         }
         elseif ($_GET['upd'] === "Title") {
             if (!isset($_GET['Title'])) {
                 $idMovie = (int)$_GET['Film'];
                 $movie = \Entity\Movie::FindMovieById($idMovie);
                 foreach ($movie as $ligne) {
                     $page = new \Html\WebPage($ligne->getTitle());
                     $page->appendCssUrl('/css/film.css');
                     $body = <<<HTML
        <div class='header'>
            <h1>{$ligne->getTitle()}</h1>
            <a href="accueil.php"><button type="button">Retour au menu </button> </a>
        </div>
        <main>
        <div class="film">
            <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
            <div class="infosfilm">
            <div class="ligne1">
            <div class="titre"> {$ligne->getTitle()}</div>
            <div class="date"> {$ligne->getReleaseDate()}</div>
            </div>
            <div class="OriginalTitle"><form action="Update.php" method="GET"> <input type="text" name="Title" placeholder=" {$ligne->getOriginalTitle()}"></div> 
            <div class="Slogan">{$ligne->getTagline()}</div>
            <div class="Resume">{$ligne->getOverview()}</div>
            </div>
        </div>     
HTML;
                     $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
                     foreach ($people as $line) {
                         $idPeople = $line->getId();
                         $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

                         $role = $cast->getRole();
                         $idAvatar = $line->getAvatarId();
                         $body .= <<<HTML
            <a href="acteur.php?avatarId={$line->getId()}"><div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                <div class="infosacteur">
                <div class="role"> <p> {$role} </p>  </div>
                <div class="Name_Actor"> <p> {$line->getName()} </p></div>
                </div>
            </div>
            </a>
HTML;
                     }

                 }
                 $body .= <<<HTML
        </main>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()}
        </footer>
HTML;

                 $page->appendContent($body);
                 echo($page->toHTML());
             }
             else {

             }
         }
         elseif ($_GET['upd'] === "Slogan") {
             if (!isset($_GET['Title'])) {
                 $idMovie = (int)$_GET['Film'];
                 $movie = \Entity\Movie::FindMovieById($idMovie);
                 foreach ($movie as $ligne) {
                     $page = new \Html\WebPage($ligne->getTitle());
                     $page->appendCssUrl('/css/film.css');
                     $body = <<<HTML
        <div class='header'>
            <h1>{$ligne->getTitle()}</h1>
            <a href="accueil.php"><button type="button">Retour au menu </button> </a>
        </div>
        <main>
        <div class="film">
            <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
            <div class="infosfilm">
            <div class="ligne1">
            <div class="titre"> {$ligne->getTitle()}</div>
            <div class="date"> {$ligne->getReleaseDate()}</div>
            </div>
            <div class="OriginalTitle">{$ligne->getOriginalTitle()}</div> 
            <div class="Slogan"><form action="Update.php" method="GET"> <input type="text" name="Title" placeholder="{$ligne->getTagline()}"></div>
            <div class="Resume">{$ligne->getOverview()}</div>
            </div>
        </div>     
HTML;
                     $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
                     foreach ($people as $line) {
                         $idPeople = $line->getId();
                         $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

                         $role = $cast->getRole();
                         $idAvatar = $line->getAvatarId();
                         $body .= <<<HTML
            <a href="acteur.php?avatarId={$line->getId()}"><div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                <div class="infosacteur">
                <div class="role"> <p> {$role} </p>  </div>
                <div class="Name_Actor"> <p> {$line->getName()} </p></div>
                </div>
            </div>
            </a>
HTML;
                     }

                 }
                 $body .= <<<HTML
        </main>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()}
        </footer>
HTML;

                 $page->appendContent($body);
                 echo($page->toHTML());
             } else {

             }
         }
         elseif ($_GET['upd'] === "Resume") {
             if (!isset($_GET['Title'])) {
                 $idMovie = (int)$_GET['Film'];
                 $movie = \Entity\Movie::FindMovieById($idMovie);
                 foreach ($movie as $ligne) {
                     $page = new \Html\WebPage($ligne->getTitle());
                     $page->appendCssUrl('/css/film.css');
                     $body = <<<HTML
        <div class='header'>
            <h1>{$ligne->getTitle()}</h1>
            <a href="accueil.php"><button type="button">Retour au menu </button> </a>
        </div>
        <main>
        <div class="film">
            <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
            <div class="infosfilm">
            <div class="ligne1">
            <div class="titre"> {$ligne->getTitle()}</div>
            <div class="date"> {$ligne->getReleaseDate()}</div>
            </div>
            <div class="OriginalTitle">{$ligne->getOriginalTitle()}</div> 
            <div class="Slogan"> {$ligne->getTagline()}  </div>
            <div class="Resume"> <form action="Update.php" method="GET"> <textarea name="Resume" rows="4" cols="100"> {$ligne->getOverview()}</textarea> <input type="submit" value="Envoie nouveau slogan"> </div>
            </div>
        </div>     
HTML;
                     $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
                     foreach ($people as $line) {
                         $idPeople = $line->getId();
                         $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

                         $role = $cast->getRole();
                         $idAvatar = $line->getAvatarId();
                         $body .= <<<HTML
            <a href="acteur.php?avatarId={$line->getId()}"><div class="people">
                <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                <div class="infosacteur">
                <div class="role"> <p> {$role} </p>  </div>
                <div class="Name_Actor"> <p> {$line->getName()} </p></div>
                </div>
            </div>
            </a>
HTML;
                     }

                 }
                 $body .= <<<HTML
        </main>
        <footer>
        <p> Dernière Modification {$page::getLastModififcation()}
        </footer>
HTML;

                 $page->appendContent($body);
                 echo($page->toHTML());
             } else {

             }

         }
         elseif ($_GET['upd'] === "Tit") {
             if (!isset($_GET['Tit'])) {
                 $idMovie = (int)$_GET['Film'];
                 $movie = \Entity\Movie::FindMovieById($idMovie);
                 foreach ($movie as $ligne) {
                     $page = new \Html\WebPage($ligne->getTitle());
                     $page->appendCssUrl('/css/film.css');
                     $body = <<<HTML
                <div class='header'>
                    <h1>{$ligne->getTitle()}</h1>
                    <a href="accueil.php"><button type="button">Retour au menu </button> </a>
                </div>
                <main>
                <div class="film">
                    <img src ='poster.php?id={$ligne->getPosterId()}'  alt='Image {$ligne->getTitle()}'/>
                    <div class="infosfilm">
                    <div class="ligne1">
                    <div class="titre">  <form action="Update.php" method="GET"> <input type="text" name="Title" placeholder=" {$ligne->getTitle()}"></div>
                    <div class="date"> {$ligne->getReleaseDate()}</div>
                    </div>
                    <div class="OriginalTitle">{$ligne->getOriginalTitle()}</div> 
                    <div class="Slogan">{$ligne->getTagline()}</div>
                    <div class="Resume">{$ligne->getOverview()}</div>
                    </div>
                </div>     
        HTML;
                             $people = \Entity\Collection\PeopleCollection::getAllPeopleByMovie($idMovie);
                             foreach ($people as $line) {
                                 $idPeople = $line->getId();
                                 $cast = \Entity\Cast::getCastById($idMovie, $idPeople);

                                 $role = $cast->getRole();
                                 $idAvatar = $line->getAvatarId();
                                 $body .= <<<HTML
                    <a href="acteur.php?avatarId={$line->getId()}"><div class="people">
                        <div class="avatar"> <img src ='avatar.php?id={$line->getAvatarId()}'  alt='Image {$line->getName()}'/> </div>
                        <div class="infosacteur">
                        <div class="role"> <p> {$role} </p>  </div>
                        <div class="Name_Actor"> <p> {$line->getName()} </p></div>
                        </div>
                    </div>
                    </a>
        HTML;
                             }

                         }
                         $body .= <<<HTML
                </main>
                <footer>
                <p> Dernière Modification {$page::getLastModififcation()}
                </footer>
        HTML;

                         $page->appendContent($body);
                         echo($page->toHTML());
             } else {

             }
         }

     }
 }