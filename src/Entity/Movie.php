<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\MovieCollection;
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
    private int $id;



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
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



    public static function FindMovieById(int $id): array|false
    {
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT  posterId , originalLanguage , originalTitle , overview , releaseDate , runtime , tagline , title , id
            FROM movie
            WHERE id = :id 
SQL
        );
        $sql -> execute([":id"=>$id]);
        return $sql -> fetchAll(PDO::FETCH_CLASS , Movie::class);

    }


    public static function createMovie(int $posterId=Null , string $originalLanguage=Null , string $originalTitle=Null , string $overivew=Null , string $releaseDate=Null, int $runtime=Null , string $tagline=null , string $title=null , )
    {
            $sql = MyPdo::getInstance()->prepare(
              <<<SQL
                INSERT INTO movie (iorignalLanguage,originalTitle,overview,posterId,releaseDate,runtime,tagline,title)
                VALUES (:originalLanguage,:originalTitle,:overview,:posterId,TO_DATE(:releaseDate,'JJ/MM/YYYY'),:runtime,:tagline,:title)
            SQL);
            $sql->execute([ ":originalLanguage"=>$originalLanguage , ":originalTitle"=>$originalTitle,":overview"=>$overivew,":posterId"=>$posterId,":releaseDate"=>$releaseDate,":tagline"=>$tagline,":title"=>$title]);

    }

    public static function deleteMovie(int $id){
        $sql=MyPdo::getInstance()->prepare(
            <<<SQL
            DELETE FROM movie
            WHERE id = :id;
            DELETE FROM cast
            WHERE idMovie = :id ; 
            DELETE FROM movie_genre
            WHERE movieID = :id;
SQL
        );


        $sql->execute([':id'=>$id]);
    }



}