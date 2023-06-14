<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class People
{
    private ?int $avatarId;
    private ?string $birthday;
    private ?string $deathday;
    private string $name;
    private string $biography;
    private ?string $placeOfBirth;
    private int $id;

    /**
     * @return int
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * @return string
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public static function FindPeopleById(int $id): array|false
    {
        $sql = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT  avatarId , birthday , deathday , name , biography , placeofBirth, id
            FROM people
            WHERE id = :id 
SQL
        );
        $sql->execute([":id" => $id]);
        return $sql->fetchAll(PDO::FETCH_CLASS, People::class);
    }

}