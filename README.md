# 🔐 Dammos's Server Setup

Ein einfaches Webserver-Projekt mit HTML, CSS, JS und Login-Funktion — bereit für den Einsatz auf einem Apache2-Server.

---
##  📄 downloade wichtiger sachen

#save vergesse ich es einzutragen

-sudo apt install php libapache2-mod-php
---

## 📦 Projektübersicht

- Klassische `index.html` als Startseite
- `login.html` mit Formular zur Anmeldung
- `style.css` für modernes Design
- `main.js` für einfache Validierung
- `user.json` zur Speicherung von Benutzerprofilen
- Automatisches Deployment über Bash-Skript

---

## 🚀 Automatisches Deployment

Dieses Projekt enthält ein Bash-Skript, das dein Repository automatisch von GitHub lädt und direkt in deinen Apache2-Webserver installiert.

### 📄 Deployment-Skript

🔗 [deploy.sh auf GitHub ansehen](https://github.com/Dammo44/server/blob/main/deploy.sh)

Führe das Skript aus mit:

```bash
sudo bash deploy.sh
