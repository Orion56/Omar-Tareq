<?php

namespace App\Database\Models;

use App\Database\Models\Model;
use App\Database\Models\Contracts\Crud;

class User extends Model implements Crud
{
    private $id, $first_name, $last_name, $phone, $email, $password, $gender, $verification_code, $image,
        $status, $email_verified_at, $created_at, $updated_at;
    const TABLE = "users";

    /**
     * Get the value of id
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
    /**
     * Get the value of first_name
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
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
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
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
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of verification_code
     */
    public function getVerification_code()
    {
        return $this->verification_code;
    }

    /**
     * Set the value of verification_code
     *
     * @return  self
     */
    public function setVerification_code($verification_code)
    {
        $this->verification_code = $verification_code;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
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
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of email_verified_at
     */
    public function getEmail_verified_at()
    {
        return $this->email_verified_at;
    }

    /**
     * Set the value of email_verified_at
     *
     * @return  self
     */
    public function setEmail_verified_at($email_verified_at)
    {
        $this->email_verified_at = $email_verified_at;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    public function create(): bool
    {
        $query = "INSERT INTO " . self::TABLE . " (first_name,last_name,phone,email,password,gender,verification_code) 
       VALUES ( ? , ? , ? , ? , ? , ? , ?)";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $bind = $stmt->bind_param(
            "ssssssi",
            $this->first_name,
            $this->last_name,
            $this->phone,
            $this->email,
            $this->password,
            $this->gender,
            $this->verification_code
        );
        return $stmt->execute();
    }
    public function read()
    {
    }
    public function update(): bool
    {
        $query = "UPDATE " . self::TABLE . " SET first_name = ? , last_name = ? , gender = ? WHERE email = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ssss', $this->first_name, $this->last_name, $this->gender, $this->email);
        return $stmt->execute();
    }
    public function delete()
    {
    }

    public function checkVerificationCode()
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE email = ? AND verification_code = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('si', $this->email, $this->verification_code);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUserByEmail()
    {
        $query = "SELECT * FROM " . self::TABLE . " WHERE email = ? ";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        return $stmt->get_result();
    }



    public function emailVerification(): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `email_verified_at` = ? WHERE email = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ss', $this->email_verified_at, $this->email);
        return $stmt->execute();
    }

    public function updateVerificationCode(): bool
    {
        $query = "UPDATE" . " " . self::TABLE . " " . "SET `verification_code` = ? WHERE email = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('is', $this->verification_code, $this->email);
        return $stmt->execute();
    }

    public function changePassword(): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `password` = ? WHERE email = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ss', $this->password, $this->email);
        return $stmt->execute();
    }

    public function updateProfilePic(): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `image` = ? WHERE email = ?";
        $stmt = $this->con->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ss', $this->image, $this->email);
        return $stmt->execute();
    }
}
