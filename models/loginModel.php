<?php
namespace projet2_Mailhiot\models;

use PDO;

class loginModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function login($email, $password)
    {

        $user = $this->getUserByEmail($email);

        if ($user) {

            if (password_verify($password, $user['pwd'])) {
                return $user;
            }
        }

        return false;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>