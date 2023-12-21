<?php
class CRUD
{
    public $userId;
    public $connexion;
    public function __construct()
    {
        $host = "localhost";
        $db = "ecom2_project";
        $user = "root";
        $password = "";

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $this->connexion = new PDO($dsn, $user, $password);
            if ($this->connexion) {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getAll(string $table): array
    {

        $PDOStatement = $this->connexion->query("SELECT * FROM $table ORDER BY id ASC");
        $data = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function getById(string $table, int $id): array
    {
        $PDOStatement = $this->connexion->prepare("SELECT * FROM $table WHERE id = :id");
        $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
        $PDOStatement->execute();
        $data = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function getByUsername(string $username, string $password)
    {
        $PDOStatement = $this->connexion->prepare("SELECT username, pwd, id, role_id FROM user WHERE username = :username AND pwd = :pwd"); // preparation de rqt sql pour affichage 
        $PDOStatement->bindParam(':username', $username, PDO::PARAM_STR);
        $PDOStatement->bindParam(':pwd', $password, PDO::PARAM_STR);
        $PDOStatement->execute();
        $data = $PDOStatement->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            session_start();
            $_SESSION['userId'] = $data['id'];
            return $data;
        }
        return false;
    }

    public function addUser(string $request, array $itemdata): int|bool
    {
        $PDOStatement = $this->connexion->prepare($request);
        foreach ($itemdata as $key => $value) {
            if (is_int($value)) {
                $PDOStatement->bindValue(':' . $key, $value, PDO::PARAM_INT);
            } else {
                $PDOStatement->bindValue(':' . $key, $value, PDO::PARAM_STR);
            }
        }
        $PDOStatement->execute();
        if ($PDOStatement) {
            return $this->connexion->lastInsertId();
        } else {
            return false;
        }
    }


    public function modifier(string $table, int $id, string $request): string
    {
        $element = $this->getById($table, $id);
        if ($element) {
            $PDOStatement = $this->connexion->prepare($request);
            $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
            $PDOStatement->execute();
            return "le user avec le id : a été mis a jour";
        } else {
            return "erreur";
        }
    }

    public function supprimer(string $table, int $id): string
    {
        $element = $this->getById($table, $id);
        if ($element) {
            $PDOStatement = $this->connexion->prepare("DELETE FROM $table WHERE id = :id");
            $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
            $PDOStatement->execute();
            return "lutilisateur a ete supprimer";
        } else {
            return "erreur";
        }
    }





}
