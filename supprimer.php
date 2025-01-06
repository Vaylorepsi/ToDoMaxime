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
    if (isset($_POST['confirmer'])) {
        $sql = "DELETE FROM taches WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer la tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Supprimer la tâche</h1>
</header>

<main>
    <p>Voulez-vous vraiment supprimer la tâche suivante ?</p>
    <p><strong><?= htmlspecialchars($tache['titre']) ?></strong></p>
    <p><?= nl2br(htmlspecialchars($tache['description'])) ?></p>
    
    <form action="" method="post" style="margin-top: 20px;">
        <button type="submit" name="confirmer" 
                class="button-link button-link-danger"
                style="border: none;">
            Confirmer
        </button>
        
        <button type="submit" name="annuler" 
                class="button-link"
                style="border: none; background-color: #6c757d;">
            Annuler
        </button>
    </form>
</main>

<footer>
    <p style="font-size: 0.9em; color: #555;">
        <a href="index.php" class="button-link">Retour à la liste</a>
    </p>
</footer>

</body>
</html>
