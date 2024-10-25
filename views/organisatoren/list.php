<h1>Organisatoren in het systeem</h1>
<table>
   <tr>
        <th>Naam</th>
        <th>Aanbelvolen door</th>
        <th>functie</th>
        <th>Acties</th>
    </tr>
    <?php foreach ($organisatoren as $organisator) { ?>
        <tr>
            <td><?php echo $organisator->naam; ?></td>
            <td><?php echo $organisator->aanbevolen_organisator_id; ?></td>
            <td><?php echo $organisator->functie; ?></td>
        
            <td>
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>">Details</a>
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>/edit">Bewerken</a>
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>/delete">Verwijderen</a>
            </td>
        </tr>
    <?php } ?>
</table>