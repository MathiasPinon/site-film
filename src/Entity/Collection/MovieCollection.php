<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use PDO;
use Entity\People;


class MovieCollection
{
    /**
     * Méthode de classe qui permet de donner tous les films
     * @return array
     */
    public static function getAllMovie():array{
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT posterId , originalLanguage , originalTitle , overview , releaseDate , runtime , tagline , title , id
            FROM movie 
        
SQL );
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_CLASS,Movie::class );
    }

    public static function getAllMovieByPeople(int $idPeople){
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT m.posterId , m.originalLanguage , m.originalTitle , m.overview , m.releaseDate , m.runtime , m.tagline , m.title , m.id
            FROM movie m
            INNER JOIN cast c ON (m.id = c.movieId)
            WHERE peopleId = :idPeople
SQL
        );

        $sql->execute([':idPeople' => $idPeople]);
        return $sql->fetchAll(PDO::FETCH_CLASS,Movie::class);
    }

}