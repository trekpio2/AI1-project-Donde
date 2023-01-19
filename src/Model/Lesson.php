<?php
namespace App\Model;

use App\Service\Config;
#TODO find i findAll zamiana na inne
class Lesson
{
    private ?int $id = null;
    private ?string $name = null;
    private ?int $id_worker = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Lesson
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Lesson
    {
        $this->name = $name;

        return $this;
    }

    public function getWorkerId(): ?int
    {
        return $this->id_worker;
    }

    public function setWorkerId(?int $id_worker): Lesson
    {
        $this->id_worker = $id_worker;

        return $this;
    }

    public static function fromArray($array): Lesson
    {
        $lesson = new self();
        $lesson->fill($array);

        return $lesson;
    }

    public function fill($array): Lesson
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['id_worker'])) {
            $this->setWorkerId($array['id_worker']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM lesson';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $lessons = [];
        $lessonsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($lessonsArray as $lessonArray) {
            $lessons[] = self::fromArray($lessonArray);
        }

        return $lessons;
    }

    public static function find($id): ?Lesson
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM lesson WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $lessonArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $lessonArray) {
            return null;
        }
        $lesson = Lesson::fromArray($lessonArray);

        return $lesson;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO lesson (name, id_worker,) VALUES (:name, :id_worker)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':name' => $this->getName(),
                ':id_worker' => $this->getWorkerId(),
 
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE lesson SET name = :name, z = :id_worker WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':name' => $this->getName(),
                ':id_worker' => $this->getWorkerId(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM lesson WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setName(null);
        $this->setWorkerId(null);
    }
}