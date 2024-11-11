 <script>
    function toggleOrganisatorInput() {
        const select1 = document.getElementById("organisator_id");
        const extraInputField1 = document.getElementById("newOrganisatorField");

        // Controleer of de geselecteerde optie "Voeg Organisator Toe" is
        if (select1.value === "") {
            extraInputField1.style.display = "block"; // Toon het invoerveld
        } else {
            extraInputField1.style.display = "none"; // Verberg het invoerveld
        }
    }
    function toggleCategorieInput() {
        const select = document.getElementById("categorie_id");
        const extraInputField = document.getElementById("newCategorieField");

        // Controleer of de geselecteerde optie "Voeg Categorie Toe" is
        if (select.value === "") {
            extraInputField.style.display = "block"; // Toon het invoerveld
        } else {
            extraInputField.style.display = "none"; // Verberg het invoerveld
        }
    }
</script>
<form method="POST">
    <!-- <input type=""> -->
    <label for="evenement_naam">Evenement naam:</label>
    <br>
    <input type="text" id="evenement_naam" name="evenement_naam" value="" placeholder="Evenement naam" required>
    <br>

    <label for="evenement_omschrijving">Informatie:</label>
    <br>
    <textarea id="evenement_omschrijving" name="evenement_omschrijving" placeholder="Omschrijving van het evenement" required></textarea>
    <br>

    <label for="evenement_datum">Datum:</label>
    <br>
    <input type="datetime-local" id="evenement_datum" name="evenement_datum" value="" required>
    <script>
        document.getElementById("evenement_datum").value = new Date(new Date().setHours(1, 0, 0, 0)).toISOString().slice(0, 16);
    </script>
    <br>
    <label for="locatie_volledig">Adres:</label>
    <br>
    <input type="text" id="locatie_volledig" name="locatie_volledig" value="" placeholder="Straat Nr, Postcode Stad" required >
    <br>

    <label for="evenement_prijs">Prijs:</label>
    <br>
    <input type="number" step="0.01" id="evenement_prijs" name="evenement_prijs" value="" placeholder="00.00" required>
    <br>

    <label for="categorie_naam">Categorie:</label>
    <br>
    <select name="categorie_id" id="categorie_id" onchange="toggleCategorieInput()">
        <?php foreach ($categorieen as $cat) { ?>
            <option value="<?= $cat->categorie_id ?>"><?= $cat->naam ?></option>
        <?php } ?>
        <option value="">Voeg nieuwe categorie toe...</option>
    </select>
    <div id="newCategorieField" style="display: none;">
        <label for="newCategorieNaam">Nieuwe categorie Naam:</label>
        <input type="text" id="newCategorieNaam" name="newCategorieNaam" placeholder="Create new categorie">
        
    </div> 
    <br>
    <label for="organisator_naam">Organisator:</label>
    <br>
    <select name="organisator_id" id="organisator_id" onchange="toggleOrganisatorInput()">
      
        <?php foreach ($organisatoren as $org) { ?>
            <option value="<?= $org->organisator_id ?>"> <?= $org->naam ?>: <?=$org->functie?></option>
        <?php } ?>
        <option value="">Voeg nieuwe organisator toe...</option>
    </select>
    <div id="newOrganisatorField" style="display: none;">
        <label for="newOrganisatorNaam">Nieuwe organisator Naam:</label>
        <input type="text" id="newOrganisatorNaam" name="newOrganisatorNaam" placeholder="Create new organisator">
        <br>
        <label for="newOrganisatorFunctie">Nieuwe organisator Functie:</label>
        <input type="text" id="newOrganisatorFunctie" name="newOrganisatorFunctie" placeholder="Create new organisator functie">
    </div>
    <br>
    <button type="submit">Voeg evenement toe</button>
</form>


<h1>Evenementen in het systeem</h1>
<form method="get">
    <input type="text" name="search" placeholder="Zoekterm" value="">
    <button type="submit">Zoeken</button>
</form>
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


