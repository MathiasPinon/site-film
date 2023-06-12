<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Movie
{
    private int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private string $overview;
    private string $releaseDate;
    private int $runtime;
    private string $tagline ;
    private string $title ;

    /**
     * Getter de Poster Id
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Getter de Original Title
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * Getter de Realease Date
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * Getter de TagLine
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * Getter du titre
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * Méthode de classe qui permet de donner tous les films
     * @return array
     */
    public static function getAllMovie():array{
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT posterId , originalLanguage , originalTitle , overview , releaseDate , runtime , tagline , title 
            FROM movie 
        
SQL );

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }
}