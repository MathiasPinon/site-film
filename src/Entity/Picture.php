<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;

class Picture
{
    private int $id;
    private string $jpeg ;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Méthode de fonction qui permet de trouver une image d'un film grace à l'identifiant du poster
     * @param int $id
     * @param string $jpeg
     */

    public static function findPosterById(int $idPoster){
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
                SELECT i.id , i.jpeg 
                FROM image i
                INNER JOIN movie m ON (i.id = m.posterId)
                WHERE m.posterId = :Id 
SQL

        );

        $sql->execute([':Id'=> $idPoster]);
        return $sql->fetchAll(\PDO::FETCH_CLASS , Picture::class);
    }

    public static function findAvatarById(int $avatarId){
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT i.id , i.jpeg 
                FROM image i
                INNER JOIN poeple p ON (i.id = p.avatarId)
                WHERE m.avatarId = :Id
SQL
        );

        $sql->execute([':Id'=> $avatarId]);
        return $sql->fetchAll(\PDO::FETCH_CLASS , Picture::class);

    }
}