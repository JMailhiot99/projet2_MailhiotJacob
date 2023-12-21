<?php

namespace projet2_Mailhiot\models;

include_once('../util/database.php');
use PDO;
use PDOException;
use PDORow;

class accueilModel
{
    public $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function getProduits()
    {
        $query = $this->db->query("SELECT * FROM product");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProduitById($produitId)
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :product_id");
        $query->bindParam(':product_id', $produitId);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getProduitRecent()
    {
        $query = $this->db->query("SELECT * FROM product ORDER BY id DESC LIMIT 3");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajoutPanier($userId, $produitId, $quantitee)
    {
        try {

            $orderId = $this->commandeUser($userId);

            $requetePdCe = $this->db->prepare("SELECT * FROM order_has_product WHERE order_id = :order_id AND product_id = :product_id");
            $requetePdCe->bindParam(':order_id', $orderId);
            $requetePdCe->bindParam(':product_id', $produitId);
            $requetePdCe->execute();
            $requetePdCe = $requetePdCe->fetch(PDO::FETCH_ASSOC);

            if ($requetePdCe) {

                $nouvQuantitee = $requetePdCe['quantity'] + $quantitee;
                $modifRequetePdCe = $this->db->prepare("UPDATE order_has_product SET quantity = :quantity WHERE id = :id");
                $modifRequetePdCe->bindParam(':quantity', $nouvQuantitee);
                $modifRequetePdCe->bindParam(':id', $requetePdCe['id']);
                $modifRequetePdCe->execute();
            } else {

                $ajouteReqPdCe = $this->db->prepare("INSERT INTO order_has_product (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
                $ajouteReqPdCe->bindParam(':order_id', $orderId);
                $ajouteReqPdCe->bindParam(':product_id', $produitId);
                $ajouteReqPdCe->bindParam(':quantity', $quantitee);
                $ajouteReqPdCe->execute();
            }

            return true;
        } catch (PDOException $e) {

            error_log("erreur d'ajout au panier: " . $e->getMessage());
            return false;
        }
    }
    public function commandeUser($userId)
    {
        try {

            $reqCommande = $this->db->prepare("SELECT id FROM user_order WHERE user_id = :user_id AND status = 'open'");
            $reqCommande->bindParam(':user_id', $userId);
            $reqCommande->execute();
            $commande = $reqCommande->fetch(PDO::FETCH_ASSOC);

            if ($commande) {

                return $commande['id'];
            } else {

                $ajoutReqCommande = $this->db->prepare("INSERT INTO user_order (user_id, status, created_at) VALUES (:user_id, 'open', NOW())");
                $ajoutReqCommande->bindParam(':user_id', $userId);
                $ajoutReqCommande->execute();

                return $this->db->lastInsertId();
            }
        } catch (PDOException $e) {

            error_log("error : " . $e->getMessage());
            return null;
        }
    }

    public function numeroCommande()
    {

        $length = 10;
        $characters = '0123456789';
        $reference = '';

        for ($i = 0; $i < $length; $i++) {
            $reference .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $reference;
    }

    public function userCart($userId)
    {

        $req = $this->db->prepare("SELECT product.* FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = :user_id");
        $req->bindParam(':user_id', $userId);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalPanier($userId)
    {
        $req = $this->db->prepare("SELECT SUM(product.price) AS total_price FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = :user_id");
        $req->bindParam(':user_id', $userId);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        return $result['total_price'] ?? 0;
    }

}
