<?php
require_once 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];


$sql = "SELECT * FROM taches WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$tache = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tache) {
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';

    $sql = "UPDATE taches SET titre = :titre, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Modifier la tâche</h1>
</header>

<main>
    <form method="post">
        <p>
            <label for="titre">Titre :</label><br>
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($tache['titre']) ?>" required>
        </p>
        <p>
            <label for="description">Description :</label><br>
            <textarea id="description" name="description" rows="5"><?= htmlspecialchars($tache['description']) ?></textarea>
        </p>
        <p>
            <button type="submit">Mettre à jour</button>
        </p>
    </form>
</main>

<footer>
    <p><a href="index.php" class="button-link">Retour à la liste</a></p>
</footer>
</body>
</html>
