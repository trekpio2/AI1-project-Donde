<?php
namespace App\Model;

use App\Service\Config;
#TODO find i findAll zamiana na inne
class Schedule
{
    private ?string $date = null;
    private ?string $time = null;
    private ?int $id_room = null;
    private ?int $id_lesson = null;


    public function getRoomId(): ?int
    {
        return $this->id_room;
    }

    public function setRoomId(?int $id_room): Schedule
    {
        $this->id_room = $id_room;

        return $this;
    }

    public function getLessonId(): ?int
    {
        return $this->id_lesson;
    }

    public function setLessonId(?int $id_lesson): Schedule
    {
        $this->id_lesson = $id_lesson;

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

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): Schedule
    {
        $this->time = $time;

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
        if (isset($array['id_room'])) {
            $this->setRoomId($array['id_room']);
        }
        if (isset($array['id_lesson'])) {
            $this->setLessonId($array['id_lesson']);
        }
        if (isset($array['date'])) {
            $this->setDate($array['date']);
        }
        if (isset($array['time'])) {
            $this->setTime($array['time']);
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
            $sql = "INSERT INTO schedule (id_room, id_lesson, date, time) VALUES (:id_room, :id_lesson, :date, :time)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':id_room' => $this->getRoomId(),
                ':id_lesson' => $this->getLessonId(),
                ':date' => $this->getdate(),
                ':time' => $this->getTime(),
                
            ]);
        } else {
            $sql = "UPDATE schedule SET id_room = :id_room, id_lesson = :id_lesson, date = :date, time = :time WHERE id_room = :id_room AND id_lesson = :id_lesson";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':id_room' => $this->getRoomId(),
                ':id_lesson' => $this->getLessonId(),
                ':date' => $this->getdate(),
                ':time' => $this->getTime(),
            ]);
        }
    }
    
    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM schedule WHERE id_room = :id_room AND id_lesson = :id_lesson";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id_room' => $this->getRoomId(),
            ':id_lesson' => $this->getLessonId(),
        ]);

        $this->setRoomId(null);
        $this->setLessonId(null);
        $this->setdate(null);
        $this->setTime(null);
    }
}