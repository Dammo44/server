#!/bin/bash

echo "🚀 Starte System-Setup für Dammo's Server..."

# Root-Rechte prüfen
if [ "$EUID" -ne 0 ]; then
  echo "❌ Bitte führe dieses Skript mit sudo aus."
  exit 1
fi

# Update & Upgrade
echo "📦 Aktualisiere Paketlisten..."
apt update && apt upgrade -y

# Apache2 installieren
echo "🌐 Installiere Apache2..."
apt install apache2 -y

# PHP & Apache-Modul installieren
echo "🧠 Installiere PHP und Apache-PHP-Modul..."
apt install php libapache2-mod-php -y

# jq installieren (für JSON-Verarbeitung)
echo "📊 Installiere jq..."
apt install jq -y

# Git installieren (falls nicht vorhanden)
echo "📁 Installiere Git..."
apt install git -y

# Restart Apache
echo "🔄 Starte Apache2 neu..."
systemctl restart apache2

echo "✅ Setup abgeschlossen! Dein Server ist bereit für Dammo's Projekt."