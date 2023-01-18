<?php
namespace App\Model;

use App\Service\Config;

class Building
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $street = null;
    private ?string $number = null;
    private ?string $postCode = null;
    private ?string $city = null;
    private ?string $image = null;
    private ?string $latitude = null;
    private ?string $longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Building
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Building
    {
        $this->name = $name;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): Building
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): Building
    {
        $this->number = $number;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): Building
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): Building
    {
        $this->city = $city;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): Building
    {
        $this->image = $image;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): Building
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): Building
    {
        $this->longitude = $longitude;

        return $this;
    }

    public static function fromArray($array): Building
    {
        $building = new self();
        $building->fill($array);

        return $building;
    }

    public function fill($array): Building
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['street'])) {
            $this->setStreet($array['street']);
        }
        if (isset($array['number'])) {
            $this->setNumber($array['number']);
        }
        if (isset($array['postCode'])) {
            $this->setPostCode($array['postCode']);
        }
        if (isset($array['city'])) {
            $this->setCity($array['city']);
        }
        if (isset($array['image'])) {
            $this->setImage($array['image']);
        }
        if (isset($array['latitude'])) {
            $this->setLatitude($array['latitude']);
        }
        if (isset($array['longitude'])) {
            $this->setLongitude($array['longitude']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM building';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $buildings = [];
        $buildingsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($buildingsArray as $buildingArray) {
            $buildings[] = self::fromArray($buildingArray);
        }

        return $buildings;
    }

    public static function find($id): ?Building
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM building WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $buildingArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $buildingArray) {
            return null;
        }
        $building = Building::fromArray($buildingArray);

        return $building;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO building (name, street, number, postCode, city, image, latitude, longitude) VALUES (:name, :street, :number, :postCode, :city, :image, :latitude, :longitude)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':name' => $this->getName(),
                ':street' => $this->getStreet(),
                ':number' => $this->getNumber(),
                ':postCode' => $this->getPostCode(),
                ':city' => $this->getCity(),
                ':image' => $this->getImage(),
                ':latitude' => $this->getLatitude(),
                ':longitude' => $this->getLongitude(),
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE building SET name = :name, street = :street, number = :number, postCode = :postCode, city = :city, image = :image, latitude = :latitude, longitude = :longitude WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':name' => $this->getName(),
                ':street' => $this->getStreet(),
                ':number' => $this->getNumber(),
                ':postCode' => $this->getPostCode(),
                ':city' => $this->getCity(),
                ':image' => $this->getImage(),
                ':latitude' => $this->getLatitude(),
                ':longitude' => $this->getLongitude(),
                ':id' => $this->getId(),
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM building WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setName(null);
        $this->setStreet(null);
        $this->setNumber(null);
        $this->setPostCode(null);
        $this->setCity(null);
        $this->setImage(null);
        $this->setLatitude(null);
        $this->setLongitude(null);
    }
}