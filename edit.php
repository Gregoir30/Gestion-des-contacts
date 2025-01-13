<?php
require 'db.php';
require 'includes/header.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID invalide.");
}

// Préparation de la requête pour récupérer les informations du contact
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    die("Contact introuvable.");
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données envoyées
    $nom = trim($_POST['nom']);
    $numero = trim($_POST['numero']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $adresse = trim($_POST['adresse']);

    if (empty($nom) || empty($numero) || empty($adresse)) {
        $error = "Tous les champs sont obligatoires sauf l'email.";
    } elseif (!$email) {
        $error = "L'email est invalide.";
    }

    // Si tout est valide, on met à jour le contact
    if (!isset($error)) {
        $stmt = $pdo->prepare("UPDATE contacts SET nom = ?, numero = ?, email = ?, adresse = ? WHERE id = ?");
        $stmt->execute([$nom, $numero, $email, $adresse, $id]);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Contact</title>
</head>
<body>
    <h1>Modifier un Contact</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom : <input type="text" name="nom" value="<?= htmlspecialchars($contact['nom']) ?>" required></label><br>
        <label>Numéro : <input type="text" name="numero" value="<?= htmlspecialchars($contact['numero']) ?>" required></label><br>
        <label>Email : <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>"></label><br>
        <label>Adresse : <textarea name="adresse" required><?= htmlspecialchars($contact['adresse']) ?></textarea></label><br>
        <button type="submit">Modifier</button>
    </form>

    <a href="index.php">Retour</a>
</body>
</html>
