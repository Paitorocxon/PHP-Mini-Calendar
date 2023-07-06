<?php
$database = new SQLite3('calendar.db');

$query = "CREATE TABLE IF NOT EXISTS events (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    description TEXT,
    date TEXT
)";
$database->exec($query);

$query = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT
)";
$database->exec($query);


$database->close();

echo "Database created!";
?>
