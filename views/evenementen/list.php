<h1>Evenementen in het systeem</h1>
<table>
    <tr>
        <th>Naam</th>
        <th>Omschrijving</th>
        <th>Locatie</th>
        <th>Datum</th>
        <th>Prijs</th>
        <th>organisator</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($evenementen as $evenement) { ?>
        <tr>
            <td><?php echo $evenement->naam; ?></td>
            <td><?php echo $evenement->omschrijving; ?></td>
            <td><?php echo $evenement->locatie; ?></td>
            <td><?php echo $evenement->datum; ?></td>
            <td><?php echo $evenement->prijs; ?></td>
            <td><?php echo $evenement->organisator; ?></td>
        
            <td>
                <a href="/evenementen/<?php echo $evenement->evenement_id; ?>">Details</a>
                <a href="/evenementen/<?php echo $evenement->evenement_id; ?>/edit">Bewerken</a>
                <a href="/evenementen/<?php echo $evenement->evenement_id; ?>/delete">Verwijderen</a>
            </td>
        </tr>
    <?php } ?>
</table>
