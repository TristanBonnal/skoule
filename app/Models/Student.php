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
     * @var int
     */
    private $teacher_id;

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
        
        $sql = "
            INSERT INTO `student` (firstname, lastname, status, teacher_id)
            VALUES (:firstname, :lastname,:status, :teacher_id)
        ";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue('firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue('lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue('status', $this->status, PDO::PARAM_INT);
        $pdoStatement->bindValue('teacher_id', $this->status, PDO::PARAM_INT);
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
    
        $sql = "
            UPDATE `student` 

            SET firstname = :firstname, 
            lastname = :lastname, 
            status = :status,
            teacher_id = :teacher_id,
            updated_at = NOW()

            WHERE id = :id
        ";
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue('id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue('firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue('lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue('status', $this->status, PDO::PARAM_INT);
        $pdoStatement->bindValue('teacher_id', $this->status, PDO::PARAM_INT);
        $pdoStatement->execute();


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

    /**
     * Get the value of teacher_id
     *
     * @return  int
     */ 
    public function getTeacher_id()
    {
        return $this->teacher_id;
    }

    /**
     * Set the value of teacher_id
     *
     * @param  int  $teacher_id
     *
     * @return  self
     */ 
    public function setTeacher_id(int $teacher_id)
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }
}
