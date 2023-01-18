<?php
namespace App\Model;

use App\Service\Config;
#TODO find i findAll zamiana na inne
class Room
{
    private ?int $id = null;
    private ?int $buildingId = null;
    private ?string $number = null;
    private ?string $floor = null;
    private ?string $roomType = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Room
    {
        $this->id = $id;

        return $this;
    }

    public function getBuildingId(): ?int
    {
        return $this->buildingId;
    }

    public function setBuildingId(?int $buildingId): Room
    {
        $this->buildingId = $buildingId;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): Room
    {
        $this->number = $number;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): Room
    {
        $this->floor = $floor;

        return $this;
    }

    public function getRoomType(): ?string
    {
        return $this->roomType;
    }

    public function setRoomType(?string $roomType): Room
    {
        $this->roomType = $roomType;

        return $this;
    }

    public static function fromArray($array): Room
    {
        $room = new self();
        $room->fill($array);

        return $room;
    }

    public function fill($array): Room
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['buildingId'])) {
            $this->setName($array['buildingId']);
        }
        if (isset($array['number'])) {
            $this->setWorkerId($array['number']);
        }
        if (isset($array['floor'])) {
            $this->setFloor($array['floor']);
        }
        if (isset($array['roomType'])) {
            $this->setRoomType($array['roomType']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM room';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $rooms = [];
        $roomsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($roomsArray as $roomArray) {
            $rooms[] = self::fromArray($roomArray);
        }

        return $rooms;
    }

    public static function find($id): ?Room
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM room WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $roomArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $roomArray) {
            return null;
        }
        $room = Room::fromArray($roomArray);

        return $room;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO room (buildingId, number, floor, roomType) VALUES (:buildingId, :number, :floor, :roomType)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':buildingId' => $this->getBuildingId(),
                ':number' => $this->getNumber(),
                ':floor' => $this->getFloor(),
                ':roomType' => $this->getRoomType(),
 
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE room SET buildingId = :buildingId, number = :number, floor = :floor, roomType = :roomType WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':buildingId' => $this->getBuildingId(),
                ':number' => $this->getNumber(),
                ':floor' => $this->getFloor(),
                ':roomType' => $this->getRoomType(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM room WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setBuildingId(null);
        $this->setNumber(null);
        $this->setFloor(null);
        $this->setRoomType(null);
    }
}