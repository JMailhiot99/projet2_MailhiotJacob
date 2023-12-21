<?php

include_once "../controllers/loginController.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <style>
        body,
        h1,
        h2,
        h3,
        p,
        ul,
        li,
        form,
        button,
        a {
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #fff;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem 0;
        }

        .header-content {
            width: 90%;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            color: #ffa500;
        }

        .dark-nav {
            background-color: #000;
            color: #fff;
        }

        .dark-nav ul {
            display: flex;
            justify-content: center;
            padding: 0.5rem 0;
        }

        .dark-nav ul li {
            padding: 0.5rem 1rem;
        }

        .dark-nav ul li a {
            color: #ffa500;
            font-weight: bold;
        }

        .dark-nav ul li a:hover {
            color: #fff;
            background-color: #ffa500;
        }

        .main {
            padding: 2rem;
        }

        main h1 {
            text-align: center;
            margin-bottom: 1rem;
        }

        main ul {
            list-style-type: none;
            width: 80%;
            margin: auto;
        }

        main ul li {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        main ul li form {
            margin-left: 1rem;
        }

        button {
            background-color: #ffa500;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #cc8400;
        }

        .cart {
            display: flex;
            align-items: center;
        }

        #shopping-cart {
            width: 32px;
            height: 32px;
        }

        #cart-count {
            background-color: #ffa500;
            color: #fff;
            padding: 0.2rem 0.6rem;
            border-radius: 50%;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
    </style>

</head>


<body>

    <header>
        <div class="header-content">
            <h1>NHL SHOP - PANIER</h1>
            <div class="cart">
                <a href="index.php?page=panier">
                    <img id="shopping-cart" src="image/shopping-cart.png" alt="Panier">
                    <span id="cart-count">
                        <?php echo count($_SESSION['panier'] ?? []); ?>
                    </span>
                </a>
            </div>
        </div>
    </header>

    <nav class="dark-nav">
        <ul>
            <li><a href="../views/accueil.php">Accueil</a></li>
            <li><a href="../views/register.php">Inscription</a></li>
            <li><a href="../views/login.php">Connexion</a></li>
            <li><a href="../views/panier.php">Panier</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="profil.php">Mon Profil</a></li>
                <li><a href="index.php?page=deconnexion">Déconnexion</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1): ?>
                <li><a href="admin.php">Section admin </a></li>
            <?php endif; ?>

        </ul>
    </nav>

    <main>
        <h1>Votre panier</h1>
        <?php if (empty($_SESSION['panier'])): ?>
            <p>Votre panier est vide.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($_SESSION['panier'] as $produitId => $quantite): ?>
                    <li>
                        Produit ID:
                        <?php echo $produitId; ?>, Quantité:
                        <?php echo $quantite; ?>
                        <!-- Formulaire pour retirer du panier -->
                        <form method="post" action="panier.php">
                            <input type="hidden" name="product_id" value="<?php echo $produitId; ?>">
                            <input type="hidden" name="action" value="remove_from_cart">
                            <button type="submit">Retirer</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>

</body>

</html>