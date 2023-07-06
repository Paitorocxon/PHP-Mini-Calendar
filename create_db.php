<?php
// Verbindung zur SQLite-Datenbank herstellen
$database = new SQLite3('calendar.db');

// Tabelle 'events' erstellen, falls sie noch nicht existiert
$query = "CREATE TABLE IF NOT EXISTS events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    date TEXT,
    time TEXT
)";
$database->exec($query);

// Datenbankverbindung schließen
$database->close();

echo "Datenbank erfolgreich erstellt!";
?>
