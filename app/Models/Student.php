<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Student extends CoreModel
{

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
     * Méthode permettant de récupérer un enregistrement de la table Student en fonction d'un id donné
     *
     * @param int $studentId ID de la catégorie
     * @return Student
     */
    public static function find($studentId)
    {
        $pdo = Database::getPDO();

        $sql = 'SELECT * FROM `student` WHERE `id` =' . $studentId;

        $pdoStatement = $pdo->query($sql);

        $student = $pdoStatement->fetchObject(self::class);

        return $student;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table student
     *
     * @return Student[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `student`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }



    public function insert()
    {
        $pdo = Database::getPDO();
        //TODO
        // $sql = "
        //     INSERT INTO `student` (name, subtitle, picture, home_order)
        //     VALUES (:name, :subtitle, :picture,:home_order)
        // ";
        //TODO
        // $pdoStatement = $pdo->prepare($sql);
        // $pdoStatement->bindValue('name', $this->name, PDO::PARAM_STR);
        // $pdoStatement->bindValue('subtitle', $this->subtitle, PDO::PARAM_STR);
        // $pdoStatement->bindValue('home_order', $this->home_order, PDO::PARAM_INT);
        // $pdoStatement->bindValue('picture', $this->picutre, PDO::PARAM_STR);
        // $pdoStatement->execute();

        // $insertedRows = $pdoStatement->rowCount();

        // if ($insertedRows > 0) {
        //     $this->id = $pdo->lastInsertId();
        //     return true;
        // }
        // return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();
        //TODO
        // $sql = "
        //     UPDATE `student` 

        //     SET name = :name, 
        //         subtitle = :subtitle, 
        //         picture = :picture, 
        //         home_order = :home_order,
        //         updated_at = NOW()

        //     WHERE id = :id
        // ";
        
        // $pdoStatement = $pdo->prepare($sql);
        //TODO
        // $pdoStatement->execute([
        //     'name' => $this->name,
        //     'subtitle' => $this->subtitle,
        //     'picture' => $this->picture,
        //     'home_order' => $this->home_order,
        //     'id' => $this->id
        // ]);

        // $updatedRows = $pdoStatement->rowCount();

        // if ($updatedRows > 0) {
        //     $this->id = $pdo->lastInsertId();
        //     return true;
        // }
        // return false;
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "
            DELETE FROM student WHERE id = :id LIMIT 1
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

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string  $lastname
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */ 
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }
}
