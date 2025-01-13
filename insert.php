<?php
require 'db.php'; // Inclure votre fichier de connexion à la base de données

// Exemple de tableau de contacts à insérer (1000 contacts)
$contacts = [];
for ($i = 1; $i <= 1000; $i++) {
    $contacts[] = [
        'nom' => 'Nom' . $i,
        'numero' => '12345678' . $i,
        'email' => 'email' . $i . '@example.com',
        'adresse' => 'Adresse ' . $i
    ];
}

try {
    // Commencer une transaction pour une insertion plus rapide
    $pdo->beginTransaction();

    // Construction de la requête d'insertion en batch
    $sql = "INSERT INTO contacts (nom, numero, email, adresse) VALUES ";
    $values = [];
    $params = [];

    foreach ($contacts as $contact) {
        $values[] = "(?, ?, ?, ?)";
        $params[] = $contact['nom'];
        $params[] = $contact['numero'];
        $params[] = $contact['email'];
        $params[] = $contact['adresse'];
    }

    // Ajouter les valeurs à la requête SQL
    $sql .= implode(", ", $values);

    // Préparer la requête
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête avec tous les paramètres
    $stmt->execute($params);

    // Valider la transaction
    $pdo->commit();

    echo "Les 1000 contacts ont été ajoutés avec succès !";

} catch (PDOException $e) {
    // Annuler la transaction en cas d'erreur
    $pdo->rollBack();
    
    // Afficher un message d'erreur générique
    die("Erreur lors de l'ajout des contacts : " . $e->getMessage());
}
?>
