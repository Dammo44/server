#!/bin/bash

USER_FILE="user.json"

echo "🧑‍💻 Neuen Benutzer hinzufügen"

# Eingaben abfragen
read -p "Name: " username
read -p "Profilname: " profile_name

# Passwort sicher abfragen
read -s -p "Passwort: " password
echo
read -s -p "Passwort erneut: " confirm
echo

# Passwort prüfen
if [ "$password" != "$confirm" ]; then
    echo "❌ Passwörter stimmen nicht überein."
    exit 1
fi

# Rang abfragen
read -p "Rang (user/mod/owner): " rank

# Passwort hashen mit PHP
hashed=$(php -r "echo password_hash('$password', PASSWORD_DEFAULT);")

# JSON-Eintrag vorbereiten
new_user=$(cat <<EOF
{
  "profile_name": "$profile_name",
  "password": "$hashed",
  "username": "$username",
  "rank": "$rank"
}
EOF
)

# JSON-Datei aktualisieren
if [ ! -f "$USER_FILE" ]; then
    echo "[$new_user]" > "$USER_FILE"
else
    tmp=$(mktemp)
    jq ". += [$new_user]" "$USER_FILE" > "$tmp" && mv "$tmp" "$USER_FILE"
fi

echo "✅ Benutzer erfolgreich hinzugefügt!"