<script>
    function toggleOrganisatorInput() {
        var select = document.getElementById("organisator_id");
        var newOrganisatorField = document.getElementById("newOrganisatorField");
        if (select.value === "") {
            newOrganisatorField.style.display = "block";
        } else {
            newOrganisatorField.style.display = "none";
        }
    }
</script>
<form method="POST">
    <label for="organisator_naam">Naam:</label>
    <br>
    <input type="text" id="organisator_naam" name="organisator_naam" value="" required>
    <br>

    <label for="organisator_functie">Functie:</label>
    <br>
    <input type="text" id="organisator_functie" name="organisator_functie" value="" required>
    <br>
    <label for="hoofdorganisator_naam">Hoofdorganisator:</label>
    <br>
    <select name="hoofdorganisator_naam" id="hoofdorganisator_id">
        <option value=''>Geen hoofdorganisator geselecteer</option>
        <?php foreach ($hoofdorganisatoren as $org) { ?>
            <option value="<?= $org->organisator_id ?>"><?= $org->organisator_naam ?>: <?=$org->organisator_functie?></option>
        <?php } ?>
    </select>
    <br>
    <button type="submit" name="update">Opslaan</button>
</form>

<h1>Organisatoren in het systeem</h1>
<form method="get">
    <input type="text" name="search" placeholder="Zoekterm" value="">
    <button type="submit">Zoeken</button>
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
                <a href="/organisatoren/<?php echo $organisator->organisator_id; ?>">Details / Edit</a>
            </td>
        </tr>
    <?php } ?>
</table>