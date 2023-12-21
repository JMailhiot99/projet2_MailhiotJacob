<?php
include_once "../controllers/loginController.php";


$connect = new login;
$conn = $connect->loginUser();

?>

<html>

<head>

    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
        input {
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            color: #ffa500;
        }

        .dark-nav {
            background-color: #000;
            color: #fff;
            padding: 0.5rem 0;
        }

        .dark-nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
        }

        .dark-nav ul li {
            padding: 0 1rem;
        }

        .dark-nav ul li a {
            color: #ffa500;
            text-decoration: none;
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

        form {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .label {
            display: block;
            margin-bottom: .5rem;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 10px);
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            background-color: #ffa500;
            color: #fff;
            cursor: pointer;
            font-size: 1rem;
        }

        button[type="submit"]:hover {
            background-color: #cc8400;
        }
    </style>


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

    <form action="#" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom d'utilisateur : </label>
            <input type="text" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe : </label>
            <input type="password" class="form-control" id="pwd" name="pwd">
        </div>
        <button type="submit" name="submit">Connexion</button>
    </form>

</html>