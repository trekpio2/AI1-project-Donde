<?php
namespace App\Model;

use App\Service\Config;
#TODO find i findAll zamiana na inne
class Schedule
{
    private ?string $date = null;
    private ?string $hour = null;
    private ?int $roomId = null;
    private ?int $lessonId = null;


    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

    public function setRoomId(?int $roomId): Schedule
    {
        $this->roomId = $roomId;

        return $this;
    }

    public function getLessonId(): ?int
    {
        return $this->lessonId;
    }

    public function setLessonId(?int $lessonId): Schedule
    {
        $this->lessonId = $lessonId;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): Schedule
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(?string $hour): Schedule
    {
        $this->hour = $hour;

        return $this;
    }

    public static function fromArray($array): Schedule
    {
        $schedule = new self();
        $schedule->fill($array);

        return $schedule;
    }

    public function fill($array): Schedule
    {
        if (isset($array['roomId'])) {
            $this->setRoomId($array['roomId']);
        }
        if (isset($array['lessonId'])) {
            $this->setLessonId($array['lessonId']);
        }
        if (isset($array['date'])) {
            $this->setDate($array['date']);
        }
        if (isset($array['hour'])) {
            $this->setHour($array['hour']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM schedule';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $schedules = [];
        $schedulesArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($schedulesArray as $scheduleArray) {
            $schedules[] = self::fromArray($scheduleArray);
        }

        return $schedules;
    }
    
    public static function find($id): ?Schedule
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM schedule WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $scheduleArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $scheduleArray) {
            return null;
        }
        $schedule = Schedule::fromArray($scheduleArray);

        return $schedule;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getRoomId()) {
            $sql = "INSERT INTO schedule (roomId, lessonId, date, hour) VALUES (:roomId, :lessonId, :date, :hour)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':roomId' => $this->getRoomId(),
                ':lessonId' => $this->getLessonId(),
                ':date' => $this->getdate(),
                ':hour' => $this->getHour(),
                
            ]);
        } else {
            $sql = "UPDATE schedule SET roomId = :roomId, lessonId = :lessonId, date = :date, hour = :hour WHERE roomId = :roomId AND lessonId = :lessonId";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':roomId' => $this->getRoomId(),
                ':lessonId' => $this->getLessonId(),
                ':date' => $this->getdate(),
                ':hour' => $this->getHour(),
            ]);
        }
    }
    
    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM schedule WHERE roomId = :roomId AND lessonId = :lessonId";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':roomId' => $this->getRoomId(),
            ':lessonId' => $this->getLessonId(),
        ]);

        $this->setRoomId(null);
        $this->setLessonId(null);
        $this->setdate(null);
        $this->setHour(null);
    }
}