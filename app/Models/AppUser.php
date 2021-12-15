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
        //TODO
        // $pdo = Database::getPDO();

        // $sql = "
        //     INSERT INTO `app_user` (email, password, firstname, lastname, role, status)
        //     VALUES (:email, :password, :firstname,:lastname, :role, :status)
        // ";
        // $pdoStatement = $pdo->prepare($sql);

        // $pdoStatement->execute([
        //     'email' => $this->email,
        //     'password' => $this->password,
        //     'firstname' => $this->firstname,
        //     'lastname' => $this->lastname,
        //     'role' => $this->role,
        //     'status' => $this->status
        // ]);

        // $insertedRows = $pdoStatement->rowCount();

        // if ($insertedRows > 0) {
        //     $this->id = $pdo->lastInsertId();

        //     return true;
        // }
        // return false;
    }

    public function update()
    {
        //TODO
        // $pdo = Database::getPDO();

        // $sql = "
        //     UPDATE `app_user` 

        //     SET email = :email, 
        //         password = :password, 
        //         firstname = :firstname, 
        //         lastname = :lastname,
        //         role = :role,
        //         status = :status,
        //         updated_at = NOW()

        //     WHERE id = :id
        // ";
        
        // $pdoStatement = $pdo->prepare($sql);

        // $pdoStatement->execute([
        //     'id' => $this->id,
        //     'email' => $this->email,
        //     'password' => $this->password,
        //     'firstname' => $this->firstname,
        //     'lastname' => $this->lastname,
        //     'role' => $this->role,
        //     'status' => $this->status
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