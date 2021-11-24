<?php
// Initialiseer de sessie
session_start();

// Controleer of de gebruiker is ingelogd, zo niet, stuur hem dan door naar de Login pagina
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: cclogin.php");
    exit;
}
require_once ("ccdatabase.php");
$sql = "SELECT * FROM reserveringssysteem";
$showresult = mysqli_query($db, $sql)
or die('Error: '.$sql);

//Loop through the result to create a custom array
$reserveringen = [];
while ($row = mysqli_fetch_assoc($showresult)) {
    $reserveringen[] = $row;
}
mysqli_close($db);


?>
<!doctype html>
<html lang="en">
<head>
    <title>Reserveringen</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="ccoverzichtstyle.css"/>
</head>

<body>
<section>
<style>
    h1 {
        color: white;
    }
</style>
<h1>Curry Corner Reserveringen</h1>
<table>
    <thead>
    <tr bgcolor="white">
        <th>#</th>
        <th>Naam</th>
        <th>Telefoonnummer</th>
        <th>E-mail</th>
        <th>Datum</th>
        <th>Tijd</th>
        <th>Aantal Personen</th>
        <th>Opmerkingen</th>
        <th colspan="2">Verandering</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10" bgcolor="white">&copy; Curry Corner Reserveringen</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($reserveringen as $reservering) { ?>
        <tr>
            <td><?= htmlspecialchars($reservering['id']); ?></td>
            <td><?= htmlspecialchars($reservering['naam']); ?></td>
            <td><?= htmlspecialchars($reservering['telefoonnummer']); ?></td>
            <td><?= htmlspecialchars($reservering['mail']); ?></td>
            <td><?= htmlspecialchars($reservering['datum']); ?></td>
            <td><?= htmlspecialchars($reservering['tijd']); ?></td>
            <td><?= htmlspecialchars($reservering['personen']); ?></td>
            <td ><?= htmlspecialchars($reservering['opmerkingen']); ?></td>
            <td><a href="ccedit.php?id=<?= htmlspecialchars($reservering['id']); ?>">Edit</a></td>
            <td><a href="ccdelete.php?id=<?= htmlspecialchars($reservering['id']); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<form action="cclogout.php">
    <input type="submit" class="btn" value="Log Out"/>
</form>
</section>
</body>
</html>