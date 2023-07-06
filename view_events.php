<?php
// Verbindung zur SQLite-Datenbank herstellen
$database = new SQLite3('calendar.db');

// Alle Termine aus der Tabelle 'events' abrufen
$query = "SELECT * FROM events";
$result = $database->query($query);

// Termine ausgeben
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "ID: " . $row['id'] . "<br>";
    echo "Titel: " . $row['title'] . "<br>";
    echo "Beschreibung: " . $row['description'] . "<br>";
    echo "Datum: " . $row['date'] . "<br><br>";
}

// Datenbankverbindung schließen
$database->close();
?>
