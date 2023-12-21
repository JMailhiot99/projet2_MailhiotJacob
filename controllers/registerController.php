<?php
require_once "../util/CRUD.php";
class register extends CRUD
{
    function generateRandomToken($length = 64)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomToken = '';

        for ($i = 0; $i < $length; $i++) {
            $randomToken .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomToken;
    }


    public function createUser()
    {

        if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $strname = $_POST['strname'];
            $strnumber = $_POST['strnumber'];
            $city = $_POST['city'];
            $province = $_POST['state'];
            $zip = $_POST['zip'];
            $country = $_POST['country'];


            $reqAdresse = "INSERT INTO address (street_name, street_nb, city, province, zipcode, country ) VALUES (:strname, :strnumber, :city, :province, :zip, :country)";
            $infoAdresse = [
                'strname' => $strname,
                'strnumber' => $strnumber,
                'city' => $city,
                'province' => $province,
                'zip' => $zip,
                'country' => $country
            ];

            try {

                $crudAdresse = new Crud();
                $newUserAdresse = $crudAdresse->addUser($reqAdresse, $infoAdresse);
                $billing_address_id = $newUserAdresse;

                $shipping_address_id = $newUserAdresse;

                $requete = "INSERT INTO user (email, token, username, fname, lname, pwd, billing_address_id, shipping_address_id, role_id) VALUES (:email, :token, :username, :fname, :lname, :pwd, $billing_address_id, $shipping_address_id, 3)";
                $itemData = [
                    'email' => $email,
                    'token' => '',
                    'username' => $username,
                    'fname' => $fname,
                    'lname' => $lname,
                    'pwd' => $password,
                ];

                $crudUser = new Crud();
                $newUserInfo = $crudUser->addUser($requete, $itemData);

                if ($newUserInfo && $newUserAdresse) {
                    echo 'alert("Vous êtes maintenant inscris");';
                } else {
                    echo 'alert("Erreur lors de linscription");';
                }
            } catch (PDOException $e) {
                echo 'console.error("PDOException: ' . $e->getMessage() . '")';
                echo 'alert("Erreur lors de linscription");';
            }
        }
    }
}