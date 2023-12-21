<?php
require_once '../util/CRUD.php';

class login extends CRUD
{
    public function loginUser()
    {
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['pwd'];

            try {
                $user = $this->getByUsername($username, $password);

                if ($user !== false) {
                    session_start();
                    $_SESSION['userId'] = $user['id'];

                    if ($user['role_id'] == 1) {

                        header("Location: ../views/accueil.php");
                        exit();
                    }
                } else {
                    echo 'console.error("username ou mdp incorrect")';
                }
            } catch (PDOException $e) {
                echo 'console.error("PDOException: ' . $e->getMessage() . '")';
            }
        }
    }
}
?>