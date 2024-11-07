<h1>Evenementen in het systeem</h1>
<table>
    <tr>
        <th>Naam</th>
        <th>Omschrijving</th>
        <th>Datum</th>
        <th>Locatie</th>
        <th>Prijs</th>
        <th>categorie</th>
        <th>organisator</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($evenementen as $evenement) { ?>
        <tr>
            <td><?php echo $evenement->evenement_naam; ?></td>
            <td><?php echo $evenement->omschrijving; ?></td>
            <td><?php echo $evenement->datum; ?></td>
            <td><?php echo $evenement->locatie; ?></td>
            <td><?php echo $evenement->prijs; ?></td>
            <td><?php echo $evenement->categorie; ?></td>
            <td><?php echo $evenement->organisator_naam; ?></td>
        
            <td>
                <a href="/evenementen/<?php echo $evenement->evenement_id; ?>">Details / Edit</a>
            
            </td>
        </tr>
    <?php } ?>
</table>
