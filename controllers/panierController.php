<?php
session_start();
require_once '../util/CRUD.php';

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}


function ajouterAuPanier($produitId, $quantite)
{

    if (isset($_SESSION['panier'][$produitId])) {
        $_SESSION['panier'][$produitId] += $quantite;
    } else {
        $_SESSION['panier'][$produitId] = $quantite;
    }
}


function retirerDuPanier($produitId)
{
    if (isset($_SESSION['panier'][$produitId])) {
        unset($_SESSION['panier'][$produitId]);
    }
}


if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    ajouterAuPanier($_POST['product_id'], $_POST['quantity'] ?? 1);
}


if (isset($_POST['action']) && $_POST['action'] === 'remove_from_cart') {
    retirerDuPanier($_POST['product_id']);
}


?>