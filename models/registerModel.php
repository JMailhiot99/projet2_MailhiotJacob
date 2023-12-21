<?php
include_once '../util/database.php';

class registerModel
{
    private $db;
    private $table = 'user';

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    // Fonction pour enregistrer un nouvel utilisateur avec un token
    public function register($email, $username, $password, $fname, $lname, $billing_address_id, $shipping_address_id, $role_id)
    {
        $token = $this->generateToken(); // Générer un token unique

        $sql = "INSERT INTO $this->table (email, token, username, fname, lname, pwd, billing_address_id, shipping_address_id, role_id) VALUES (:email, :token, :username, :fname, :lname, :password, :billing_address_id, :shipping_address_id, :role_id)";
        $stmt = $this->db->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':billing_address_id', $billing_address_id);
        $stmt->bindParam(':shipping_address_id', $shipping_address_id);
        $stmt->bindParam(':role_id', $role_id);

        // Exécuter la requête
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Fonction privée pour générer un token aléatoire
    private function generateToken()
    {
        return bin2hex(random_bytes(16)); // 32 caractères hexadécimaux
    }
}

?>