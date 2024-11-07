<h1>Organisatoren in het systeem</h1>
<table>
   <tr>
        <th>Naam</th>
        <th>Functie</th>
        <th>Hoofd organisator</th>
        <th>Hoofd organisator functie</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($organisatoren as $organisator) { ?>
        <tr>
            <td><?php echo $organisator->organisator_naam; ?></td>
            <td><?php echo $organisator->organisator_functie; ?></td>
            <td><?php echo ($organisator->hoofdorganisator_naam==null) ? "/" :  $organisator->hoofdorganisator_naam; ?></td>
            <td><?php echo ($organisator->hoofdorganisator_functie==null)?"/": $organisator->hoofdorganisator_functie; ?></td>
        
            <td>
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>">Details</a>
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>/edit">Bewerken</a>
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>/delete">Verwijderen</a>
            </td>
        </tr>
    <?php } ?>
</table>