<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Teacher extends CoreModel
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
     * @var string
     */
    private $job;
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
        
        $sql = "
            INSERT INTO `teacher` (firstname, lastname, job, status)
            VALUES (:firstname, :lastname, :job,:status)
        ";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue('firstname', $this->firstname, PDO::PARAM_STR);
        $pdoStatement->bindValue('lastname', $this->lastname, PDO::PARAM_STR);
        $pdoStatement->bindValue('job', $this->job, PDO::PARAM_STR);
        $pdoStatement->bindValue('status', $this->status, PDO::PARAM_INT);
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
     * Get the value of job
     *
     * @return  string
     */ 
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set the value of job
     *
     * @param  string  $job
     *
     * @return  self
     */ 
    public function setJob(string $job)
    {
        $this->job = $job;

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
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }
}
