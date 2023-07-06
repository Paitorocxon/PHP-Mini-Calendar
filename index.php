<link rel="stylesheet" href="style.css">
<?php
// Verbindung zur SQLite-Datenbank herstellen
$database = new SQLite3('calendar.db');

// Monat, Jahr und Tag für die Anzeige des aktuellen Datums bestimmen
$currentMonth = date('n');
$currentYear = date('Y');
$currentDay = date('j');

// Wenn eine Navigationsaktion durchgeführt wurde, das aktualisierte Monat und Jahr abrufen
if (isset($_GET['month']) && isset($_GET['year'])) {
    $currentMonth = $_GET['month'];
    $currentYear = $_GET['year'];
}

// Ersten und letzten Tag des aktuellen Monats bestimmen
$firstDayOfMonth = strtotime("$currentYear-$currentMonth-01");
$lastDayOfMonth = strtotime(date('Y-m-t', $firstDayOfMonth));

// Wochentage mit Namen und Datum ausgeben
echo "<h1>Calendar - $currentMonth/$currentYear</h1>";

echo "<table>";
echo "<tr>";
echo "<th>Monday</th>";
echo "<th>Tuesday</th>";
echo "<th>Wednesday</th>";
echo "<th>Thursday</th>";
echo "<th>Friday</th>";
echo "<th>Saturday</th>";
echo "<th>Sunday</th>";
echo "</tr>";

// Aktuellen Monat und Jahr für den Kalender bestimmen
$calendarMonth = date('n', $firstDayOfMonth);
$calendarYear = date('Y', $firstDayOfMonth);

// Tag für den ersten Tag des Monats bestimmen
$firstDayOfWeek = date('N', $firstDayOfMonth);

// Leere Zellen für vorherige Tage ausgeben
echo "<tr>";
for ($i = 1; $i < $firstDayOfWeek; $i++) {
    echo "<td></td>";
}

// Tage des Monats ausgeben
for ($day = 1; $day <= date('t', $firstDayOfMonth); $day++) {
    $date = date('Y-m-d', strtotime("$calendarYear-$calendarMonth-$day"));

    // Termine für den aktuellen Tag abrufen
    $query = "SELECT * FROM events WHERE date = date('$date')";
    $result = $database->query($query);

    echo "<td>";
    echo "<strong>$day</strong><br>";
    echo "<ul>";
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<li>" . $row['title'] . " - " . $row['time'] . " <a href='delete_event.php?id=" . $row['id'] . "'>(Löschen)</a></li>";
    }
    echo "</ul>";
    echo "<a href='add_event.php?date=$date'>Add Appointment</a>";
    echo "</td>";

    // Neue Woche beginnen
    if (date('N', strtotime("$calendarYear-$calendarMonth-$day")) == 7) {
        echo "</tr><tr>";
    }
}

// Leere Zellen für nachfolgende Tage ausgeben
$lastDayOfWeek = date('N', $lastDayOfMonth);
if ($lastDayOfWeek < 7) {
    for ($i = $lastDayOfWeek; $i < 7; $i++) {
        echo "<td></td>";
    }
}

echo "</tr>";
echo "</table>";

// Vormonat und Vorjahr berechnen
$previousMonth = $currentMonth - 1;
$previousYear = $currentYear;
if ($previousMonth == 0) {
    $previousMonth = 12;
    $previousYear--;
}

// Folgemonat und Folgejahr berechnen
$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth == 13) {
    $nextMonth = 1;
    $nextYear++;
}

// Navigation für den Kalender
echo "<br>";
echo "<div class=\"navigation\"><a href='index.php?month=$previousMonth&year=$previousYear'>&lt; Vorheriger Monat</a> | ";
echo "<a href='index.php?month=$nextMonth&year=$nextYear'>Nächster Monat &gt;</a></div>";

// Datenbankverbindung schließen
$database->close();
?>
