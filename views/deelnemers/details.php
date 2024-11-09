<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deelnemer Informatie Bewerken</title>
</head>
<body>
<h2>Evenementen voor <?= $deelnemer->voornaam ?> <?= $deelnemer->naam ?> </h2>
    <form method="POST">
        <input type="hidden" name="deelnemer_id" value="<?= $deelnemer->deelnemer_id ?>">
        <table>
            <tr>
                <th>Evenement</th>
                <th>Datum</th>
                <th>Locatie</th>
                <th>Prijs</th>
                <th>Organisator</th>
                <th>Deelnemen</th>
            </tr>
            <?php foreach ($evenementen as $evenement): ?>
                <tr>
                    <td><?php echo htmlspecialchars($evenement->naam); ?></td>
                    <td><?php echo htmlspecialchars($evenement->datum); ?></td>
                    <td><?php echo htmlspecialchars($evenement->locatie); ?></td>
                    <td><?php echo number_format($evenement->prijs, 2); ?></td>
                    <td><?php echo htmlspecialchars($evenement->organisator); ?></td>
                    <td>
                        <input type="checkbox" name="evenementen[]"
                               value="<?php echo $evenement->evenement_id; ?>"
                               <?php echo $evenement->doet_mee ? 'checked' : ''; ?>
                        >
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit" name="update_evenementen">update_evenementen</button>
    </form>

<h2>Deelnemer informatie</h2>
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

  
</body>
</html>