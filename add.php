<?php
require 'db.php';
require 'includes/header.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $numero = htmlspecialchars(trim($_POST['numero']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $adresse = htmlspecialchars(trim($_POST['adresse']));

    if (!empty($nom) && !empty($numero)) {
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Adresse email invalide.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO contacts (nom, numero, email, adresse) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $numero, $email, $adresse]);
            $message = "Contact ajouté avec succès.";
        }
    } else {
        $message = "Le nom et le numéro sont obligatoires.";
    }
}
?>

<section>
    <h2>Ajouter un Contact</h2>
    <?php if ($message): ?>
        <p class="message"><?= $message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        
        <label>Numéro :</label>
        <input type="text" name="numero" required>
        
        <label>Email :</label>
        <input type="email" name="email">
        
        <label>Adresse :</label>
        <textarea name="adresse"></textarea>
        
        <button type="submit">Ajouter</button>
    </form>
</section>

<?php require 'includes/footer.php'; ?>
