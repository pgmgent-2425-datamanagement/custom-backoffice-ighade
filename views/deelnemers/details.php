<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deelnemer Informatie Bewerken</title>
</head>
<body>
<h2>Deelnemer informatie</h2>
<h3><?= $deelnemer->voornaam ?> <?= $deelnemer->naam ?></h3>


    <form method="POST">
        <input type="hidden" id="deelnemer_id" name="deelnemer_id" value="<?= $deelnemer->deelnemer_id ?>">
        <label for="voornaam">Voornaam:</label>
        <br>
        <input type="text" id="voornaam" name="voornaam" value="<?= htmlspecialchars($deelnemer->voornaam) ?>" required>
        <label for="naam">Naam:</label>
        <br>
        <input type="text" id="naam" name="naam" value="<?= htmlspecialchars($deelnemer->naam) ?>" required>
        <br>
        <label for="email">Email:</label>
        <br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($deelnemer->email) ?>" required>
        <br>
        <button type="submit" name="update">Opslaan</button>
        <button type="submit" name="delete">Verwijderen</button>
    </form>

<h2>Tickets van: <?= $deelnemer->naam ?> <?= $deelnemer->voornaam ?></h2>
<table>
    <tr>
        <th>Evenement</th>
        <th>Datum</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($tickets as $ticket) { ?>
        <tr>
            <td><?= $ticket->evenement_naam ?></td>
            <td><?= $ticket->evenement_datum ?></td>
            <td><?= $ticket->evenement_prijs ?></td>
        </tr>
    <?php } ?>

</body>
</html>