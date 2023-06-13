<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\People;
use PDO;

class PeopleCollection
{

    /**
     * Donne tous les acteurs d'un film en particulier
     * @param int $idMov
     * @return array|false
     */
    public static function getAllPeopleByMovie(int $idMov):array{
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
        SELECT  p.avatarId , p.birthday ,  p.deathday , p.name , p.biography , p.placeOfBirth , p.id
        FROM people p 
        INNER JOIN cast c ON (p.id = c.peopleId)
        INNER JOIN movie m ON (c.movieId = m.id)
        WHERE m.id = :id
SQL
        );

        $sql ->execute([":id"=>$idMov]);
        return $sql ->fetchAll(PDO::FETCH_CLASS,People::class);

    }

}