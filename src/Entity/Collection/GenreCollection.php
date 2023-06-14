<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;

class GenreCollection
{
    public static function  getAllGenre(){
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
                SELECT id , name 
                FROM genre
SQL
        );

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_CLASS , Genre::class);
    }


}