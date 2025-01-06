<?php
require_once 'db.php'; 
$sql = "SELECT * FROM taches ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de tâches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Gestion de Tâches</h1>
    <a href="ajouter.php" class="button-link">Ajouter une nouvelle tâche</a>
</header>

<main>
    <h2>Liste des tâches</h2>
    <?php if (!empty($taches)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($taches as $tache) : ?>
                <tr>
                    <td><?= htmlspecialchars($tache['titre']) ?></td>
                    <td><?= nl2br(htmlspecialchars($tache['description'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucune tâche n’a été ajoutée pour le moment.</p>
    <?php endif; ?>
</main>

<footer>
    <h2>Modifier ou Supprimer une tâche</h2>
    <?php if (!empty($taches)) : ?>
        <ul>
        <?php foreach ($taches as $tache) : ?>
            <li>
                <strong><?= htmlspecialchars($tache['titre']) ?></strong> :
                <a href="modifier.php?id=<?= $tache['id'] ?>" class="button-link">Modifier</a>
                <a href="supprimer.php?id=<?= $tache['id'] ?>"
                   class="button-link"
                   style="background-color: #dc3545;">
                   Supprimer
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucune tâche à modifier ou supprimer.</p>
    <?php endif; ?>
    
</footer>

</body>
</html>
