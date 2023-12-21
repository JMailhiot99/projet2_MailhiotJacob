<!DOCTYPE html>
<html>

<head>
    <style>
        /* General Reset */
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
        input,
        textarea {
            font-family: 'Arial', sans-serif;
            text-decoration: none;
            list-style: none;
        }

        body {
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
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

        /* Navigation */
        .dark-nav {
            background-color: #000;
            color: #fff;
            padding: 0.5rem 0;
        }

        .dark-nav ul {
            display: flex;
            justify-content: center;
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

        /* Cart */
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

        /* Profile Section */
        h1 {
            text-align: center;
            margin: 1rem 0;
        }

        .tableInfo {
            width: 90%;
            margin: 1rem auto;
            border-collapse: collapse;
        }

        .tableInfo td {
            padding: 0.5rem;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        /* Buttons */
        button {
            background-color: #ffa500;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            cursor: pointer;
            border-radius: 4px;
            font-size: 1rem;
            display: block;
            /* Center the button */
            width: 200px;
            /* Use a fixed width for the button */
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #cc8400;
        }

        /* Add any other styles that you need here */
    </style>
</head>

<body>

    <header>
        <div class="header-content">
            <h1>NHL-SHOP</h1>
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

    <h1>Mon Profile</h1>

    <?php
    require_once "../controllers/profileController.php";

    $information = new info();

    $userData = $information->informationUser();

    if (!empty($userData)) {
        echo '<table class="tableInfo">';
        foreach ($userData as $key => $value) {

            echo 'Email : ';
            echo $value['email'];
            echo 'Pseudo : ';
            echo $value['username'];
            echo 'Mot de passe : ';
            echo $value['pwd'];
            echo $value['fname'];
            echo $value['lname'];
        }

        echo '<Button>Supprimer mon compte</Button>';
    } else {
        echo 'Utilisateur non trouvé';
    }
    ?>
</body>

</html>