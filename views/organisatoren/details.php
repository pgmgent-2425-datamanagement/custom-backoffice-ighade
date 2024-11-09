<h1>Organisator details</h1>
<h2>Organisator Informatie</h2>
<form method="POST">
    <input type="hidden" id="organisator_id" name="organisator_id" value="<?= $organisator->organisator_id ?>">

    <label for="organisator_naam">Naam:</label>
    <br>
    <input type="text" id="organisator_naam" name="organisator_naam" value="<?= htmlspecialchars($organisator->organisator_naam) ?>" required>
    <br>

    <label for="organisator_functie">Functie:</label>
    <br>
    <input type="text" id="organisator_functie" name="organisator_functie" value="<?= htmlspecialchars($organisator->organisator_functie) ?>" required>
    <br>
    <label for="hoofdorganisator_naam">Hoofdorganisator:</label>
    <br>
    <select name="hoofdorganisator_naam" id="hoofdorganisator_id">
        <option value=''>Geen hoofdorganisator geselecteer</option>
        <?php foreach ($organisatoren as $org) { ?>
            <option value="<?= $org->organisator_id ?>" <?= $org->organisator_id == $organisator->hoofdorganisator_id ? 'selected' : '' ?>><?= $org->organisator_naam ?>: <?=$org->organisator_functie?></option>
        <?php } ?>
    </select>
    <br>
    <button type="submit" name="update">Opslaan</button>
    <button type="submit" name="delete">Verwijderen</button>
</form>
<p><i>Bij verwijdering zullen de gelelateerde evenemanten ook verwijderd worden (kijk hieronder welke dit zullen zijn).</i></p>
<br>


<h2>evenementen georganiseert door organisatie</h2>
<table>
   <?php foreach ($evenementen as $evenement) { ?>
    <tr>
        <th>Naam</th>
        <th>Omschrijving</th>
        <th>datum</th>
        <th>prijs</th>
        <th>details</th>
    </tr>
    <tr>
        <td><?= $evenement->evenement_naam; ?></td>
        <td><?= $evenement->evenement_omschrijving; ?></td>
        <td><?= $evenement->evenement_datum; ?></td>
        <td><?= $evenement->evenement_prijs; ?></td>
        <td><a href="/evenementen/<?= $evenement->evenement_id; ?>">Details</a></td>
    </tr>
   <?php } ?>
</table>

