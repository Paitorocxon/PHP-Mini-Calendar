<?php
// Verbindung zur SQLite-Datenbank herstellen
$database = new SQLite3('calendar.db');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Termin mit der angegebenen ID aus der Tabelle 'events' löschen
    $query = "DELETE FROM events WHERE id = $id";
    $database->exec($query);

    // Zurück zur Hauptseite
    header('Location: index.php');
    exit();
}

// Datenbankverbindung schließen
$database->close();
?>
