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
     * @param int $id
     * @param string $jpeg
     */

    public static function FindById(int $idPoster){
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
}