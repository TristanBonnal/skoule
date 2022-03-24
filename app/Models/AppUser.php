<?php

namespace App\Models;
use App\Utils\Database;
use \PDO;


class AppUser extends CoreModel
{
    private $email;
    private $password;
    private $name;
    private $role;
    private int $status;


    static public function find($id)
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM app_user
            WHERE id = :id
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute(['id' => $id]);

        $user = $pdoStatement->fetchObject(self::class);

        return $user;
    }

    static public function findByEmail($email)
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM app_user
            WHERE email = :email
        ';
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute(['email' => $email]);
        $user = $pdoStatement->fetchObject(self::class);

        return $user;
    }

    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `app_user`';
        $pdoStatement = $pdo->query($sql);
        $users = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $users;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `app_user` (email, password, name, role, status)
            VALUES (:email, :password, :name, :role, :status)
        ";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue('email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue('name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue('password', $this->password, PDO::PARAM_STR);
        $pdoStatement->bindValue('role', $this->role, PDO::PARAM_STR);
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

        $sql = "
            UPDATE `app_user` 

            SET email = :email, 
                password = :password, 
                name = :name, 
                role = :role,
                status = :status,
                updated_at = NOW()

            WHERE id = :id
        ";
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue('id', $this->id, PDO::PARAM_INT);
        $pdoStatement->bindValue('email', $this->email, PDO::PARAM_STR);
        $pdoStatement->bindValue('name', $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue('password', $this->password, PDO::PARAM_STR);
        $pdoStatement->bindValue('role', $this->role, PDO::PARAM_STR);
        $pdoStatement->bindValue('status', $this->status, PDO::PARAM_INT);
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
            DELETE FROM app_user WHERE id = :id LIMIT 1
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
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     */ 
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     */ 
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     */ 
    public function setStatus($status)
    {
        $this->status = $status;
    }



    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}