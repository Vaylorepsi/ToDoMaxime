<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';

    $sql = "INSERT INTO taches (titre, description) VALUES (:titre, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Ajouter une nouvelle tâche</h1>
</header>

<main>
    <form method="post">
        <p>
            <label for="titre">Titre :</label><br>
            <input type="text" name="titre" id="titre" required>
        </p>
        <p>
            <label for="description">Description :</label><br>
            <textarea name="description" id="description" rows="5"></textarea>
        </p>
        <p>
            <button type="submit">Enregistrer</button>
        </p>
    </form>
</main>

<footer>
    <p><a href="index.php" class="button-link">Retour à la liste</a></p>
</footer>
</body>
</html>
