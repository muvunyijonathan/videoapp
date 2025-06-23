<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Appel Vidéo</title>
  <style>
    body { font-family: sans-serif; background: #f2f2f2; padding: 30px; }
    .box {
      background: white;
      padding: 20px;
      border-radius: 10px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 0 10px #ccc;
      text-align: center;
    }
    a {
      text-decoration: none;
      color: #004080;
      font-weight: bold;
      margin: 0 10px;
    }
  </style>
</head>
<body>

<div class="box">
  <h2>Bienvenue <?= htmlspecialchars($user['name']) ?> 👋</h2>
  <p>Prêt pour un appel vidéo ?</p>
  <p>
    🔗 <a href="index.php">Lancer l’appel vidéo</a> |
    🔓 <a href="logout.php">Déconnexion</a>
  </p>
</div>

</body>
</html>
