<?php
namespace projet2_Mailhiot\controllers;

use projet2_Mailhiot\models\accueilModel;

class accueilController
{
    private $model;

    public function __construct(accueilModel $model)
    {
        $this->model = $model;
    }

    public function index()
    {

        $produitsRecents = $this->model->getProduitRecent();

        include 'views/accueil.php';
    }


    public function ajoutPanier($userId, $produitId, $quantitee)
    {
        $success = $this->model->ajoutPanier($userId, $produitId, $quantitee);

        if ($success) {
            header("Location: index.php?page=panier");
            exit;
        } else {
            echo "erreur lors de l'ajout au panier";
        }
    }
    public function getProduitRecent()
    {
        return $this->model->getProduitRecent();
    }

}
?>