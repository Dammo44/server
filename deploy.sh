#!/bin/bash

echo "🚀 Starte Deployment für Dammo's Server..."

# Root-Rechte prüfen
if [ "$EUID" -ne 0 ]; then
  echo "❌ Bitte führe dieses Skript mit sudo aus."
  exit 1
fi

# Zielverzeichnis
TARGET="/var/www/html"

# Repository klonen
echo "📁 Lade Projekt von GitHub..."
rm -rf "$TARGET"/*
git clone https://github.com/Dammo44/server.git /tmp/server

# Dateien kopieren
echo "📦 Kopiere Dateien nach Apache-Verzeichnis..."
cp -r /tmp/server/* "$TARGET"

# Berechtigungen setzen
echo "🔐 Setze Dateiberechtigungen..."
chown -R www-data:www-data "$TARGET"

# user.json prüfen
USER_FILE="$TARGET/user.json"
ADD_SCRIPT="$TARGET/add_user.sh"

# Wenn user.json nicht existiert → erstellen
if [ ! -f "$USER_FILE" ]; then
  echo "📄 user.json nicht gefunden – erstelle leere Datei..."
  echo "[]" > "$USER_FILE"
fi

# Prüfen ob user.json leer ist
if [ "$(jq length "$USER_FILE")" -eq 0 ]; then
  echo "👤 user.json ist leer – starte Benutzererstellung über add_user.sh..."
  if [ -f "$ADD_SCRIPT" ]; then
    chmod +x "$ADD_SCRIPT"
    sudo "$ADD_SCRIPT"
  else
    echo "⚠️ add_user.sh nicht gefunden – bitte manuell ausführen."
  fi
else
  echo "✅ user.json enthält bereits Benutzer – keine Änderungen vorgenommen."
fi

echo "✅ Deployment abgeschlossen!"