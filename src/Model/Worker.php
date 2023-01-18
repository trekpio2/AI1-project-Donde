<?php
namespace App\Model;

use App\Service\Config;
#TODO find i findAll zamiana na inne
class Worker
{
    private ?int $id = null;
    private ?int $roomId = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $title = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Worker
    {
        $this->id = $id;

        return $this;
    }

    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

    public function setRoomId(?int $roomId): Worker
    {
        $this->roomId = $roomId;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): Worker
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): Worker
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Worker
    {
        $this->title = $title;

        return $this;
    }

    public static function fromArray($array): Worker
    {
        $worker = new self();
        $worker->fill($array);

        return $worker;
    }

    public function fill($array): Worker
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['roomId'])) {
            $this->setRoomId($array['roomId']);
        }
        if (isset($array['firstName'])) {
            $this->setFirstName($array['firstName']);
        }
        if (isset($array['lastName'])) {
            $this->setLastName($array['lastName']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM worker';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $workers = [];
        $workersArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($workersArray as $workerArray) {
            $workers[] = self::fromArray($workerArray);
        }

        return $workers;
    }

    public static function find($id): ?Worker
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM worker WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $workerArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $workerArray) {
            return null;
        }
        $worker = Worker::fromArray($workerArray);

        return $worker;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO worker (roomId, firstName, lastName, title) VALUES (:roomId, :firstName, :lastName, :title)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':roomId' => $this->getRoomId(),
                ':firstName' => $this->getFirstName(),
                ':lastName' => $this->getLastName(),
                ':title' => $this->getTitle(),
 
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE worker SET roomId = :roomId, firstName = :firstName, lastName = :lastName, title = :title WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':roomId' => $this->getRoomId(),
                ':firstName' => $this->getFirstName(),
                ':lastName' => $this->getLastName(),
                ':title' => $this->getTitle(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM worker WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setRoomId(null);
        $this->setFirstName(null);
        $this->setLastName(null);
        $this->setTitle(null);
    }
}