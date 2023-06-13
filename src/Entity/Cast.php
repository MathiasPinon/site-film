<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Cast
{
    private int $movieId;
    private int $peopleId;
    private string $role;
    private int $orderIndex;
    private int $id;

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }
    
    public static function getCastById(int $movieId , int $peopleId){
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT movieId , peopleId, role , orderIndex , id
            FROM cast
            WHERE movieId = :IdMovie
            AND peopleId = :IdPeople
SQL
        );

        $sql->execute([':IdMovie'=>$movieId , ':IdPeople'=>$peopleId]);
        return $sql->fetchAll(PDO::FETCH_CLASS,Cast::class);
    }
}