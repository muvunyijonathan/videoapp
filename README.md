# videoapp
systeme d'appel video 
# 📞 Application Web d'Appel Vidéo

Cette application permet aux utilisateurs de s’inscrire, se connecter, voir qui est en ligne, et passer des appels vidéo via WebRTC. Elle est développée en **PHP**, **JavaScript**, **WebSocket** et **MySQL**, avec hébergement sur **aeonfree.com** pour la partie PHP et **Render.com** pour le serveur WebSocket.

---

## ✅ Fonctionnalités principales

- ✅ Inscription & Connexion sécurisée (PHP + MySQL)
- ✅ Liste des utilisateurs enregistrés et en ligne (WebSocket)
- ✅ Appels vidéo en peer-to-peer (WebRTC)
- ✅ Bouton pour raccrocher, mettre en sourdine, ajouter un membre (non actif)
- ✅ Interface responsive
- ✅ Notifications d’appel entrant (accepter / refuser)
- ⚙️ Prêt pour extension vers appel de groupe via **Jitsi Meet**

---

## 📦 Structure du projet


---

## 🛠 Technologies utilisées

| Technologie     | Rôle                       |
|----------------|----------------------------|
| PHP / MySQL    | Backend et gestion session |
| WebRTC         | Connexion vidéo/audio      |
| WebSocket      | Signalisation (via Node.js)|
| HTML / CSS     | Interface utilisateur      |
| JavaScript     | Contrôle WebRTC/WebSocket  |

---

## 🚀 Déploiement

### 1. Hébergement du **site PHP** (aeonfree.com)

- Crée un compte gratuit sur [aeonfree.com](https://aeonfree.com)
- Crée une base de données via VistaPanel
- Uploade les fichiers PHP via **File Manager**
- Modifie `db.php` avec tes identifiants MySQL
- Importer le fichier `.sql` dans phpMyAdmin

### 2. Hébergement du **serveur WebSocket** (Render.com)

- Crée un dépôt GitHub avec `websocket-server.js` et `package.json`
- Crée un projet Node.js sur [Render.com](https://render.com)
- Renseigne ton dépôt GitHub
- Définis le port `3000` dans `websocket-server.js` (`process.env.PORT`)
- Récupère l’URL WebSocket (`wss://xxx.onrender.com`)
- Mets à jour l’URL dans `webrtc.js`

---

## 🧪 Compte de test

```bash
Nom : moise
Email : moise@example.com
Mot de passe : 123456

📌 À venir
 Appels de groupe avec Jitsi Meet

 Historique des appels

 Messagerie instantanée intégrée

 Système de notifications en direct

 Ajout d'avatars utilisateurs

🧑‍💻 Auteur
Développé par Jonathan Muvunyi
