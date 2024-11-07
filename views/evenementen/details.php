<div class = "container">
    <h1>Details van evenement</h1>
    <div>
        <div >
            <h2><?php echo $evenement->evenement_naam; ?></h2>
            <p><strong>info: </strong><?php echo $evenement->evenement_omschrijving; ?></p>
            <p><strong>datum: </strong> <?php echo $evenement->evenement_datum; ?></p>
            <p><strong>address: </strong> <?php echo $evenement->locatie_volledig; ?></p>
            <p><strong>pijs: </strong> <?php echo $evenement->evenement_prijs; ?></p>
            <p><strong>categorie: </strong> <?php echo $evenement->categorie_naam; ?></p>
        </div>
    </div>
    <h2>Organisator</h2>
    <div>
        <p><strong>Naam: </strong> <?php echo $evenement->organisator_naam; ?></p>
        <p><strong>Functie: </strong> <?php echo $evenement->organisator_functie; ?></p>
    <h3>Deelnemers</h3>
    <table>
        <tr>
            <th>Naam</th>
            <th>email</th>
            <th>telefoon</th>
            <th>info</th>
        </tr>
        <?php foreach ($deelnemers as $deelnemer) { ?>
            <tr>
                <td><?php echo $deelnemer->naam; ?></td>
                <td><?php echo $deelnemer->voornaam; ?></td>
                <td><?php echo $deelnemer->email; ?></td>
                <td><a href="/deelnemers/<?php echo $deelnemer->deelnemer_id; ?>">Details</a></td>

            </tr>
        <?php } ?>
    </table>
</div>