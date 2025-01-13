<?php
require 'db.php';
require 'includes/header.php';

// Vérification de l'ID passé dans l'URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>ID invalide. <a href='index.php'>Retour à la liste</a></p>";
    exit;
}

$id = $_GET['id'];

// Requête pour récupérer les détails du contact
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification si le contact existe
if (!$contact) {
    echo "<p>Contact introuvable. <a href='index.php'>Retour à la liste</a></p>";
    exit;
}
?>

<section>
    <h2>Détails du Contact</h2>
    <table>
        <tr>
            <th>ID :</th>
            <td><?= htmlspecialchars($contact['id']); ?></td>
        </tr>
        <tr>
            <th>Nom :</th>
            <td><?= htmlspecialchars($contact['nom']); ?></td>
        </tr>
        <tr>
            <th>Numéro :</th>
            <td><?= htmlspecialchars($contact['numero']); ?></td>
        </tr>
        <tr>
            <th>Email :</th>
            <td><?= htmlspecialchars($contact['email']); ?></td>
        </tr>
        <tr>
            <th>Adresse :</th>
            <td><?= htmlspecialchars($contact['adresse']); ?></td>
        </tr>
    </table>

    <div class="actions">
        <a href="edit.php?id=<?= $contact['id']; ?>" class="btn -edit">Modifier</a>
        <a href="delete.php?id=<?= $contact['id']; ?>" class="btn -danger" 
           onclick="return confirm('Voulez-vous vraiment supprimer ce contact ?');">
            Supprimer
        </a>
        <a href="index.php" class="btn">Retour à la liste</a>
    </div>
</section>

<?php require 'includes/footer.php'; ?>
