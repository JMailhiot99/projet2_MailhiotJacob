<?php
include_once('../util/database.php');
include_once('../models/accueilModel.php');
include_once('../controllers/accueilController.php');


$database = database::getInstance();
$pdo = $database->getConnection();

$accueilModel = new \projet2_Mailhiot\models\accueilModel($pdo);
$accueilController = new \projet2_Mailhiot\controllers\accueilController($accueilModel);

if (isset($_POST['action']) && $_POST['action'] == 'add_to_cart' && isset($_POST['product_id'])) {
    $userId = $_SESSION['user_id'] ?? null;
    if ($userId) {
        $productId = $_POST['product_id'];
        $quantity = 1;
        $accueilController->ajoutPanier($userId, $productId, $quantity);
    }
}


$products = $accueilController->getProduitRecent();
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
            margin: 0 auto;
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
        }

        .dark-nav ul li {
            padding: 1rem;
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
            background-color: #f4f4f4;
        }

        .new-products {
            width: 80%;
            margin: 0 auto;
        }

        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .product img {
            max-width: 100%;
            display: block;
            margin-bottom: 1rem;
        }

        .product h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .product p {
            color: #333;
            margin-bottom: 1rem;
        }

        button {
            background-color: #ffa500;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NHL Shop</title>
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

    <main>
        <div class="new-products">
            <h2>Chandails NHL en vente</h2>
            <?php
            if (!empty($products)) {
                foreach ($products as $product) {
                    ?>
                    <div class="product">
                        <img src="images/<?php echo htmlspecialchars($product['url_img']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3>
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h3>
                        <p>Prix : $
                            <?php echo htmlspecialchars($product['price']); ?>
                        </p>
                        <form method="post" action="index.php">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="hidden" name="action" value="add_to_cart">
                            <button type="submit" name="submit">Ajouter au panier</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucun chandail disponible</p>";
            }
            ?>
        </div>
    </main>

</body>

</html>