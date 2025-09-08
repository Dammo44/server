#!/bin/bash

echo "🚀 Lade Projekt von GitHub herunter und deploye nach /var/www/html..."

# 🔐 Root-Rechte prüfen
if [ "$EUID" -ne 0 ]; then
  echo "❌ Bitte führe dieses Skript mit sudo aus."
  exit 1
fi

# 📥 GitHub-Link
GIT_REPO="https://github.com/Dammo44/server.git"

# 📁 Temporäres Verzeichnis
TMP_DIR="/tmp/server"

# 🧹 Vorheriges Verzeichnis löschen
rm -rf $TMP_DIR
git clone $GIT_REPO $TMP_DIR

# 📤 Kopiere nach /var/www/html
echo "📁 Kopiere Dateien nach /var/www/html..."
rm -rf /var/www/html/*
cp -r $TMP_DIR/* /var/www/html/

# 🔧 Rechte setzen
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

echo "✅ Deployment abgeschlossen! Projekt ist jetzt unter http://localhost/ oder deiner IP erreichbar."
