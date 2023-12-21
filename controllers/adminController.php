<?php
require_once '../util/CRUD.php';

class Produits extends CRUD
{
    public function nouveauProduit()
    {
        if (isset($_POST['submit'])) {

            $image = $_FILES['image'];
            $description = $_POST['desc'];
            $nomProduit = $_POST['name'];
            $quantity = $_POST['qty'];
            $price = $_POST['price'];

            $imageName = $image['name'];

            $sqlreq = "INSERT INTO product (name, qtty, price, url_img, description) VALUES (:productName, :quantity, :price, :imageName, :description)";
            $sqlData = [
                'imageName' => $imageName,
                'description' => $description,
                'productName' => $nomProduit,
                'quantity' => $quantity,
                'price' => $price
            ];

            $nouveauProduit = new Crud();
            $new = $nouveauProduit->addUser($sqlreq, $sqlData);

            if ($new) {
                echo 'alert("Le produit a été ajouter");';
            } else {
                echo 'alert("Error");';
            }
        }
    }
}
?>