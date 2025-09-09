Klar, Damian 👑 — hier ist deine überarbeitete README.md, bereit zum Kopieren und Einfügen:

# 🔐 Dammos's Server Setup

Ein flexibles Webserver-Projekt mit Login-System, Benutzer- und Rangverwaltung — bereit für den Einsatz auf einem Apache2-Server.

---

## 📄 Wichtige Installationen

Falls du es vergisst: hier nochmal die Basics zum Setup 😉

```bash
sudo apt install apache2
sudo apt install php libapache2-mod-php
sudo systemctl restart apache2

📦 Projektübersicht

index.php – Startseite mit Login-Session und Berechtigungsprüfung

login.html – Login-Formular

register_form.php – Benutzer erstellen (mit Rang-Dropdown)

create_rank.php – Rang erstellen (inkl. Berechtigungen)

edit_user.php / delete_user.php – Benutzer bearbeiten/löschen 👑

edit_rank.php / delete_rank.php – Rang bearbeiten/löschen 👑

style.css – Roter-schwarzer Gradient, responsive Design

user.json – Speichert Benutzerprofile

ranks.json – Speichert Ränge mit Berechtigungen

main.js – (optional) für Validierung oder UI-Extras

deploy.sh – Automatisches Deployment via Bash

🔐 Berechtigungssystem

Ränge werden in ranks.json gespeichert und steuern, was ein Benutzer darf:

{
  "name": "owner",
  "can_create_user": true,
  "can_create_rank": true,
  "can_manage_users": true,
  "can_manage_ranks": true
}

Buttons wie „User löschen“ oder „Rang ändern“ sind nur sichtbar, wenn der Rang die Berechtigung hat. 👑

🚀 Automatisches Deployment

Dieses Projekt enthält ein Bash-Skript, das dein Repository automatisch von GitHub lädt und direkt in deinen Apache2-Webserver installiert.

🔗 deploy.sh auf GitHub ansehen

sudo bash deploy.sh

🧠 Sicherheit & Features

Eigene Benutzer können sich nicht selbst löschen

Ränge können nicht gelöscht werden, wenn sie gerade aktiv sind

Alle Aktionen sind berechtigungsbasiert

Design ist mobilfreundlich und dynamisch gestreckt

🛠️ To-Do / Ideen

[ ] Benutzerliste mit Live-Vorschau

[ ] Rang-Icons oder Farben

[ ] Backup-System für JSON-Dateien

[ ] Admin-Dashboard mit Tabs

❤️ Credits

Made with Leidenschaft by Damian aka Dammo44 👑


---

Wenn du willst, kann ich dir auch eine englische Version oder ein cooles Projekt-Badge für GitHub generieren. Sag einfach Bescheid 😎
