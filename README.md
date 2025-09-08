🔐 Dammo's Server Setup

Ein vollständiges Webserver-Projekt mit HTML, CSS, JavaScript und PHP — inklusive Login-System, Rangverwaltung, Benutzererstellung und automatischem Deployment. Bereit für den Einsatz auf einem Apache2-Server.

---

📄 Wichtige Installationen

Damit alles reibungslos funktioniert, installiere folgende Pakete:

`bash
sudo apt update
sudo apt install apache2
sudo apt install php libapache2-mod-php
sudo apt install jq
sudo systemctl restart apache2
`

---

📦 Projektübersicht

- index.php als Startseite mit Rang-Erkennung und Session-Handling  
- login.html mit Formular zur Anmeldung  
- login.php zur sicheren Verarbeitung inkl. Passwort-Hashing  
- logout.php zum Abmelden  
- add_user.php zur Benutzererstellung über das Webinterface (nur für Owner)  
- add_user.sh zur Benutzererstellung direkt über den Server  
- user.json zur Speicherung aller Benutzer  
- style.css für modernes, responsives Design (auch mobil)  
- main.js für einfache Formularvalidierung  
- deploy.sh für automatisches Setup aus GitHub  

---

🚀 Automatisches Deployment

Dieses Projekt enthält ein Bash-Skript, das dein Repository automatisch von GitHub lädt und direkt in deinen Apache2-Webserver installiert.

📄 Deployment-Skript

🔗 deploy.sh auf GitHub ansehen

Führe das Skript aus mit:

`bash
sudo bash deploy.sh
`

> ⚠️ ACHTUNG: Das Skript überschreibt den Inhalt von /var/www/html und setzt Dateien direkt in deinen Apache2-Server.  
> Ich übernehme keinerlei Verantwortung für Schäden, Datenverlust oder Fehlkonfigurationen.  
> Nutze das Skript nur, wenn du weißt, was du tust — oder in einer sicheren Testumgebung.

---

🧑‍💻 Benutzer hinzufügen

Webinterface (nur für Owner)

- Nach dem Login als Owner erscheint ein Button „🧑‍💻 Benutzer hinzufügen“  
- Dort kannst du neue Benutzer mit Name, Profilname, Passwort und Rang erstellen  
- Passwörter werden automatisch gehasht und sicher gespeichert

Bash-Skript

Führe direkt auf dem Server aus:

`bash
./add_user.sh
`

Das Skript fragt dich interaktiv nach allen Daten und speichert den neuen Benutzer sicher in user.json.

---

🧪 Beispiel-Accounts

Du kannst dich direkt mit diesen Accounts einloggen:

| Benutzername | Profilname | Passwort   | Rang   |
|--------------|-------------|------------|--------|
| User         | user        | test123    | owner  |
| Moderator    | mod1        | modpass    | mod    |
| Gast         | gast        | gast123    | user   |
| AdminX       | adminx      | secure456  | owner  |

---

📱 Mobile-Kompatibilität

Alle Seiten sind für Smartphones optimiert:

- Responsive Layout mit @media-Regeln  
- Eingabefelder und Buttons passen sich der Bildschirmgröße an  
- Kein Zoomen oder Scrollen nötig  
- Saubere Darstellung auf kleinen Geräten

---

🛠️ Roadmap (To-Do-Liste)

- [x] Login mit Rang-Erkennung  
- [x] Passwort-Hashing mit password_hash()  
- [x] Benutzer hinzufügen über Web & Bash  
- [x] Mobile-Optimierung  
- [ ] Benutzerliste mit Bearbeiten/Löschen  
- [ ] SQLite-Datenbank statt JSON  
- [ ] Admin-Dashboard mit Statistiken  
- [ ] QR-Code-Login für mobile Geräte  
- [ ] Dark Mode  
- [ ] Update-Suche (automatisch prüfen, ob neue Version verfügbar ist)

---

🧑‍💻 Entwicklernotiz

Dies ist mein erster Testserver, den ich mit viel Leidenschaft und Neugier gebaut habe.  
Es werden noch viele weitere geile Funktionen folgen — von Admin-Tools bis zu QR-Login und Datenbankintegration.  
Dieses Projekt ist mein Einstieg in die Welt des Webhostings und ich freue mich auf alles, was noch kommt.