<link rel="stylesheet" href="style.css">
<?php
// Verbindung zur SQLite-Datenbank herstellen
$database = new SQLite3('calendar.db');

// Wenn das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Termin in die Tabelle 'events' einfügen
    $query = "INSERT INTO events (title, date, time) VALUES ('$title', '$date', '$time')";
    $database->exec($query);

    // Zurück zur Hauptseite
    header('Location: index.php');
    exit();
}

// Datenbankverbindung schließen
$database->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Appointment</title>
</head>
<body>
    <a href="index.php">Back</a><h1>Add Appointment</h1>

    <?php
    // Datum aus der URL abrufen
    $date = $_GET['date'];
    ?>
    <div class="termin">
        <form method="post" action="add_event.php">
            <label for="title">Title:</label>
            <input type="text" name="title" required><br>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo $date; ?>" required><br>

            <label for="time">Time:</label>
            <input type="time" name="time"><br>

            <input type="submit" value="Add Appointment">
        </form>
    </div>
</body>
</html>
