<?php
require_once '../controllers/adminController.php';
require_once '../util/CRUD.php';

$produit = new produits();
$nouveauProduit = $produit->nouveauProduit();

?>


<html>

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
        a,
        label,
        input,
        textarea {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            text-decoration: none;
            list-style: none;
        }

        body {
            background-color: #fff;
            color: #333;
            line-height: 1.6;
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
            padding: 0 1rem;
        }

        .dark-nav ul li a {
            color: #ffa500;
            font-weight: bold;
        }

        .dark-nav ul li a:hover {
            color: #fff;
            background-color: #ffa500;
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

        /* Admin section form styles */
        .addproduit {
            width: 90%;
            max-width: 600px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #f4f4f4;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .addproduit form {
            display: flex;
            flex-direction: column;
        }

        .addproduit label {
            margin-top: 1rem;
        }

        .addproduit input[type="text"],
        .addproduit input[type="number"],
        .addproduit textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .addproduit button {
            width: auto;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            background-color: #ffa500;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .addproduit button:hover {
            background-color: #cc8400;
        }
    </style>

</head>

<body>

    <header>
        <div class="header-content">
            <h1>NHL SHOP</h1>
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

    <h1>Section administrateur</h1>

    <div class="addproduit">

        <form action="#" method="POST" enctype="multipart/form-data">
            <label for="">Photo du produit</label>
            <input type="file" name="image" id="image">
            <br><br>
            <label for="">Description du produit</label>
            <textarea name="desc" id="desc" cols="20" rows="2"></textarea>
            <br><br>
            <label for="">Nom du produit</label>
            <input type="text" name="name">
            <br><br>
            <label for="">Quantité</label>
            <input type="number" name="qty">
            <br><br>
            <label for="">Prix</label>
            <input type="number" name="price">
            <br>
            <button type="submit" name="submit">Ajouter produit</button>

        </form>
    </div>

</body>

</html>