<?php
declare(strict_types=1);

$page = new \Html\WebPage("Create");

if(!isset($_POST['OrignalLanguage']))
{
    $body =<<<HTML
        <body>
        <h1> Create </h1>
        <h2> Création d'un film</h2>
        <form action="Create.php" method="POST">
        <p> Id du poster :</p>
        <input type="text" name="posterId" value=null> 
        <br>
        <p> Langue d'origine :</p>
        <select name="OrignalLanguage">
            <option value="French">French</option>  
            <option value="Spain">Spain</option>      
            <option value="English">English</option>
            <option value="Italia">Italia</option>     
            <option value="Germany">Germany</option>    
        </select>
        <p> Titre original : </p>
        <input type="text" name="originalTitle"  value=null >
        <p> Slogan du film : </p>
        <input type="text" name="overview" value=null >
        <p> Date de réalisation écrire en format (28/02/2023) </p>
        <input type="text" name="release-date"  value=null> 
        <p> Temps du film : </p>
        <input type="text" name="runtime"  value=null>
        <p> Résume du film : </p>
        <input type="text" name="tagline"  value=null >
        <p> Titre du film : </p>
        <input type="text" name="title" value=null >   
        <input type="submit" value="Creer">
        </form>
        <a href="accueil.php"><button type="button">Retour à la liste de film</button></a>  
        </body>
    HTML;

    $page->appendContent($body);
    echo($page->toHTML());
}
else{
    $posterId = (int)$_POST['posterId'];
    $OrignalLanguage = $_POST['OrignalLanguage'];
    $originalTitle = $_POST['originalTitle'];
    $overview = $_POST['overview'];
    $release_date = $_POST['release-date'];
    $runtime = (int)$_POST['runtime'];
    $tagline = $_POST['tagline'];
    $title = $_POST['title'];
     \Entity\Movie::createMovie($posterId,$OrignalLanguage,$originalTitle, $overview,$release_date,$runtime,$tagline,$title );
    $page = new \Html\WebPage("Création");
    $body =<<<HTML
            <p> Film creer </p>
             <a href="accueil.php"><button type="button">Retour à la liste de film</button></a>  
HTML;
    $page->appendContent($body);
    echo($page->toHTML());

}
