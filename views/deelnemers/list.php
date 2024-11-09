<form method="POST">
        <label for="voornaam">Voornaam:</label>
        <br>
        <input type="text" id="voornaam" name="voornaam" value="" required>
        <label for="naam">Naam:</label>
        <br>
        <input type="text" id="naam" name="naam" value="" required>
        <br>
        <label for="email">Email:</label>
        <br>
        <input type="email" id="email" name="email" value="" required>
        <br>
        <button type="submit" name="update">Opslaan</button>
    </form>

<h1>Deelnemers in het systeem</h1>
<form method="get">
    <input type="text" name="search" placeholder="Zoekterm" value="">
    <button type="submit">Zoeken</button>
</form>
<table>
    <tr>
        <th>Naam</th>
        <th>Voornaam</th>
        <th>Email</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($deelnemers as $deelnemer) { ?>
        <tr>
            <td><?php echo $deelnemer->naam; ?></td>
            <td><?php echo $deelnemer->voornaam; ?></td>
            <td><?php echo $deelnemer->email; ?></td>
        
            <td>
                <a href="/deelnemers/<?php echo $deelnemer->deelnemer_id; ?>">Details / Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>