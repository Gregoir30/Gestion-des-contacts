<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Contacts</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Activation du lien Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: rgb(33, 95, 136);
            color: white;
            padding: 20px 0;
        }
        header .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1 {
            font-size: 24px;
            margin: 0;
            display: flex;
            align-items: center;
        }
        h1 i {
            margin-right: 10px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 10px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: #555;
            border-radius: 5px;
        }
        form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border 0.3s ease;
        }
        input[type="text"]:focus {
            border-color: #28a745;
            outline: none;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        button:hover {
            background-color: #218838;
        }
        button i {
            margin-right: 5px;
        }
        /* Responsive */
        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                text-align: center;
            }
            form {
                width: 100%;
                justify-content: center;
            }
            input[type="text"] {
                width: 250px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-address-book"></i> Gestionnaire de Contacts</h1>
            <nav>
                <ul>
                    <!-- Formulaire de recherche -->
                    <li>
                        <form method="get" action="">
                            <input type="text" name="search" placeholder="Rechercher un contact" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" aria-label="Rechercher un contact">
                            <button type="submit" aria-label="Lancer la recherche"><i class="fa fa-search"></i></button>
                        </form>
                    </li>
                    <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="add.php"><i class="fas fa-plus"></i> Ajouter un Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
