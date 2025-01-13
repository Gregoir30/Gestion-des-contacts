<?php
require 'db.php';
require 'includes/header.php';

// Gestion des erreurs avec message générique
try {
    // Pagination : Définir le nombre d'éléments par page
    $contactsPerPage = 10;
    $totalContacts = $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
    $totalPages = ceil($totalContacts / $contactsPerPage);

    // Calcul de la page actuelle et de l'offset
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max(1, min($currentPage, $totalPages)); // S'assurer que la page est valide
    $offset = ($currentPage - 1) * $contactsPerPage;

    // Récupérer les résultats de recherche (si requis)
    $searchTerm = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : "%";
    
    // Requête avec tri alphabétique et pagination
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE nom LIKE :search OR numero LIKE :search ORDER BY nom ASC LIMIT :offset, :limit");
    $stmt->bindParam(':search', $searchTerm);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $contactsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Gestion des erreurs : Affichage d'un message générique
    die("Une erreur est survenue lors de la récupération des contacts. Veuillez réessayer plus tard.");
}
?>

<section class="contact-list">
    <h2>Liste des Contacts</h2>

    <?php if (empty($contacts)): ?>
        <p>Aucun contact trouvé. <a href="add.php" class="btn -primary">Ajoutez-en un !</a></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Numéro</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= htmlspecialchars($contact['id']); ?></td>
                        <td><?= htmlspecialchars($contact['nom']); ?></td>
                        <td><?= htmlspecialchars($contact['numero']); ?></td>
                        <td><?= htmlspecialchars($contact['email']); ?></td>
                        <td><?= htmlspecialchars($contact['adresse']); ?></td>
                        <td>
                            <a href="view.php?id=<?= htmlspecialchars($contact['id']); ?>" aria-label="Voir les détails de <?= htmlspecialchars($contact['nom']); ?>">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="edit.php?id=<?= htmlspecialchars($contact['id']); ?>" aria-label="Modifier <?= htmlspecialchars($contact['nom']); ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete.php?id=<?= htmlspecialchars($contact['id']); ?>" 
                               aria-label="Supprimer <?= htmlspecialchars($contact['nom']); ?>"
                               onclick="return confirm('Voulez-vous vraiment supprimer ce contact ?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

   <!-- Pagination -->
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="?page=1&search=<?= urlencode($_GET['search'] ?? ''); ?>" class="first">Premier</a>
        <a href="?page=<?= $currentPage - 1; ?>&search=<?= urlencode($_GET['search'] ?? ''); ?>" class="prev">Précédent</a>
    <?php endif; ?>

    <!-- Afficher un groupe de pages proches de la page actuelle -->
    <?php
    $start = max(1, $currentPage - 2);
    $end = min($totalPages, $currentPage + 2);
    
    for ($i = $start; $i <= $end; $i++): ?>
        <a href="?page=<?= $i; ?>&search=<?= urlencode($_GET['search'] ?? ''); ?>" 
           class="page <?= $i == $currentPage ? 'active' : ''; ?>">
            <?= $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?= $currentPage + 1; ?>&search=<?= urlencode($_GET['search'] ?? ''); ?>" class="next">Suivant</a>
        <a href="?page=<?= $totalPages; ?>&search=<?= urlencode($_GET['search'] ?? ''); ?>" class="last">Dernier</a>
    <?php endif; ?>
</div>

</section>
<br>
<br>
<?php require 'includes/footer.php'; ?>
