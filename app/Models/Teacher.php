<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Teacher extends CoreModel
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var int
     */
    private $status;

    /**
     * Méthode permettant de récupérer un enregistrement de la table Teacher en fonction d'un id donné
     *
     * @param int $teacherId ID de la catégorie
     * @return Teacher
     */
    public static function find($teacherId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `teacher` WHERE `id` =' . $teacherId;

        $pdoStatement = $pdo->query($sql);

        $teacher = $pdoStatement->fetchObject(self::class);

        return $teacher;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table teacher
     *
     * @return Teacher[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `teacher`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }



    public function insert()
    {
        $pdo = Database::getPDO();
        //TODO
        // $sql = "
        //     INSERT INTO `teacher` (name, subtitle, picture, home_order)
        //     VALUES (:name, :subtitle, :picture,:home_order)
        // ";
        //TODO
        // $pdoStatement = $pdo->prepare($sql);
        // $pdoStatement->bindValue('name', $this->name, PDO::PARAM_STR);
        // $pdoStatement->bindValue('subtitle', $this->subtitle, PDO::PARAM_STR);
        // $pdoStatement->bindValue('home_order', $this->home_order, PDO::PARAM_INT);
        // $pdoStatement->bindValue('picture', $this->picutre, PDO::PARAM_STR);
        $pdoStatement->execute();

        $insertedRows = $pdoStatement->rowCount();

        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();
        //TODO
        // $sql = "
        //     UPDATE `teacher` 

        //     SET name = :name, 
        //         subtitle = :subtitle, 
        //         picture = :picture, 
        //         home_order = :home_order,
        //         updated_at = NOW()

        //     WHERE id = :id
        // ";
        
        $pdoStatement = $pdo->prepare($sql);
        //TODO
        // $pdoStatement->execute([
        //     'name' => $this->name,
        //     'subtitle' => $this->subtitle,
        //     'picture' => $this->picture,
        //     'home_order' => $this->home_order,
        //     'id' => $this->id
        // ]);

        $updatedRows = $pdoStatement->rowCount();

        if ($updatedRows > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "
            DELETE FROM teacher WHERE id = :id LIMIT 1
        ";
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            'id' => $this->id
        ]);

        $deletedRows = $pdoStatement->rowCount();

        if ($deletedRows > 0) {
            $this->id = $pdo->lastInsertId();

            return true;
        }
        return false;
    }
}
