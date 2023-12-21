<?php
include_once "../controllers/registerController.php";
require_once "../util/CRUD.php";

$Connect = new Crud;
$conn = $Connect->__construct();



$register = new register;
$nuv = $register->createUser();

?>

<html>

<head>

    <style>
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
            color: #333;
        }

        body {
            background-color: #fff;
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

        .container-form-register {
            width: 90%;
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.2rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .btn {
            background-color: #ffa500;
            color: #fff;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
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

        @media (min-width: 768px) {

            .col-md-2,
            .col-md-3 {
                float: left;
                width: 100%;
                padding: 0 15px;
            }

            .col-md-2 {
                width: 50%;
            }

            .col-md-3 {
                width: 33.3333%;
            }

            .row::after {
                content: "";
                display: table;
                clear: both;
            }
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

    <div class="container-form-register">
        <form class="row g-3" action="#" method="POST">
            <div class="col-md-2">
                <label for="validationDefault01" class="form-label">Pénom : </label>
                <input type="text" class="form-control" id="fname" name="fname" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault01" class="form-label">Nom : </label>
                <input type="text" class="form-control" id="lname" name="lname" required>
            </div>
            <div class="col-md-3">
                <label for="validationDefault02" class="form-label">Email : </label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault02" class="form-label">Mot de passe : </label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-md-3">
                <label for="validationDefaultUsername" class="form-label">Pseudo : </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="username" name="username"
                        aria-describedby="inputGroupPrepend2" required>
                </div>
            </div>
            <div class="col-md-2">
                <label for="validationDefault03" class="form-label">Nom de votre rue : </label>
                <input type="text" class="form-control" id="strname" name="strname" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault03" class="form-label">Numero de porte : </label>
                <input type="text" class="form-control" id="strnumber" name="strnumber" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault03" class="form-label">Ville : </label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault03" class="form-label">Pays : </label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault04" class="form-label">Province : </label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="col-md-2">
                <label for="validationDefault05" class="form-label">Code Postale</label>
                <input type="text" class="form-control" id="zip" name="zip" required>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit" name="submit" onclick=<?php $nuv ?>>Valider
                    l'inscription</button>
            </div>
        </form>
    </div>