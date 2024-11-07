<h1>Deelnemers in het systeem</h1>
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