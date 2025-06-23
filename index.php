<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';
$user = $_SESSION['user'];

// Récupérer les utilisateurs depuis la base (sauf soi-même)
$stmt = $pdo->prepare("SELECT name FROM users WHERE id != ?");
$stmt->execute([$user['id']]);
$allUsers = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Appel Vidéo - <?= htmlspecialchars($user['name']) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      background: rgb(169, 185, 209);
      display: flex;
      height: 100vh;
    }
    aside {
      width: 250px;
      background: rgb(145, 187, 180);
      padding: 15px;
      border-right: 1px solid #ccc;
      overflow-y: auto;
    }
    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 10px;
    }
    h2 {
      margin-top: 0;
      color: #004080;
    }
    .user-list {
      list-style: none;
      padding: 0;
    }
    .user-list li {
      padding: 5px;
      margin: 5px 0;
      background: #eee;
      border-radius: 5px;
    }
    video {
      width: 100%;
      max-width: 400px;
      background: black;
      border: 3px solid #004080;
      border-radius: 10px;
    }
    .videos {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin: 10px 0;
    }
    .controls {
      display: flex;
      gap: 10px;
      justify-content: center;
      flex-wrap: wrap;
    }
    button {
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      background: #004080;
      color: white;
      cursor: pointer;
    }
    button:disabled {
      background: gray;
      cursor: not-allowed;
    }
    header {
      background: #004080;
      color: white;
      padding: 10px;
      text-align: center;
    }

    /* 🔔 Notification appel entrant */
    #incomingCall {
      display: none;
      position: fixed;
      top: 30%;
      left: 30%;
      background: white;
      padding: 20px;
      border: 2px solid #004080;
      border-radius: 10px;
      z-index: 1000;
      box-shadow: 0 0 10px #00000077;
      text-align: center;
    }
    #incomingCall button {
      margin: 5px;
    }
  </style>
</head>
<body>

<aside>
  <h2><?= htmlspecialchars($user['name']) ?></h2>
  <p><a href="logout.php">🔓 Déconnexion</a></p>

  <h3>👥 Utilisateurs enregistrés</h3>
  <ul class="user-list">
    <?php foreach ($allUsers as $u): ?>
      <li><?= htmlspecialchars($u) ?></li>
    <?php endforeach; ?>
  </ul>

  <h3>🟢 En ligne (WebSocket)</h3>
  <ul class="user-list" id="onlineUsers"></ul>
</aside>

<main>
  <header>
    <h2>📞 Appel Vidéo</h2>
  </header>

  <div class="videos">
    <video id="localVideo" autoplay muted></video>
    <video id="remoteVideo" autoplay></video>
  </div>

  <div class="controls">
    <select id="targetSelect">
      <option disabled selected>Choisir un utilisateur</option>
    </select>
    <button id="callBtn">Appeler</button>
    <button id="muteBtn">🔇 Sourdine</button>
    <button id="addBtn">➕ Ajouter membre</button>
    <button id="hangupBtn" disabled>Raccrocher</button>
  </div>
</main>

<!-- 🔔 Popup d’appel entrant -->
<div id="incomingCall">
  <p id="callerName">Appel entrant...</p>
  <button id="acceptCall">✅ Accepter</button>
  <button id="rejectCall">❌ Refuser</button>
</div>

<script>
  const username = "<?= htmlspecialchars($user['name']) ?>";
</script>
<script src="webrtc.js"></script>
</body>
</html>
