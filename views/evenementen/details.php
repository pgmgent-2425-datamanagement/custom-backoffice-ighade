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
            console.log('test');
            const select2 = document.getElementById("categorie_id");
            const extraInputField2 = document.getElementById("newCategorieField");

            // Controleer of de geselecteerde optie "Voeg Categorie Toe" is
            if (select2.value === "") {
                extraInputField2.style.display = "block"; // Toon het invoerveld
            } else {
                extraInputField2.style.display = "none"; // Verberg het invoerveld
            }
        }
</script>

<div class = "container">
<h1>Evenement Details</h1>

<form method="POST">
    <input type="hidden" id="evenement_id" name="evenement_id" value="<?= $evenement->evenement_id ?>">

    <label for="evenement_naam">Evenement naam:</label>
    <br>
    <input type="text" id="evenement_naam" name="evenement_naam" value="<?= htmlspecialchars($evenement->evenement_naam) ?>" required>
    <br>

    <label for="evenement_omschrijving">Informatie:</label>
    <br>
    <textarea id="evenement_omschrijving" name="evenement_omschrijving" required><?= htmlspecialchars($evenement->evenement_omschrijving) ?></textarea>
    <br>

    <label for="evenement_datum">Datum:</label>
    <br>
    <input type="datetime-local" id="evenement_datum" name="evenement_datum" value="<?= htmlspecialchars($evenement->evenement_datum) ?>" required>
    <br>
    <label for="locatie_volledig">Adres:</label>
    <br>
    
    <input type="hidden" id="locatie_id" name="locatie_id" value="<?= $evenement->locatie_id ?>">


    <input type="text" id="locatie_volledig" name="locatie_volledig" value="<?= htmlspecialchars($evenement->locatie_volledig) ?>" required>
    <br>

    <label for="evenement_prijs">Prijs:</label>
    <br>
    <input type="number" step="0.01" id="evenement_prijs" name="evenement_prijs" value="<?= htmlspecialchars($evenement->evenement_prijs) ?>" required>
    <br>

    <label for="categorie_naam">Categorie:</label>
    <br>
    <select name="categorie_id" id="categorie_id" onchange="toggleCategorieInput()">
        <?php foreach ($categorien as $cat) { ?>
            <option value="<?= $cat->categorie_id ?>" <?= $cat->categorie_id == $evenement->categorie_id ? 'selected' : '' ?>><?= $cat->naam ?></option>
        <?php } ?>
        <option value="">Voeg nieuwe categorie toe...</option>
    </select>    
    <br>
<!-- bij het selecteren van "Voeg niewuwe categorie toe" zal deze div zichtbaar zijn -->
<div id="newCategorieField" style="display: none;">
        <label for="newCategorieNaam">Nieuwe categorie Naam:</label>
        <input type="text" id="newCategorieNaam" name="newCategorieNaam" placeholder="Categorie Naam">
</div>
<!-- --------------------------------------------------------------------------------- -->

    <h2>Organisator Informatie</h2>
    <label for="organisator_naam">Naam:</label>
    <br>
    <select name="organisator_id" id="organisator_id" onchange="toggleOrganisatorInput()">
      
        <?php foreach ($organisatoren as $org) { ?>
            <option value="<?= $org->organisator_id ?>" <?= $org->organisator_id == $evenement->organisator_id ? 'selected' : '' ?>><?= $org->naam ?>: <?=$org->functie?></option>
        <?php } ?>
        <option value="">Voeg nieuwe organisator toe...</option>
    </select>
    <p><i>selecteer hier de organisatie die het evenement organiseerd</i></p>
    
<!-- bij het selecteren van "Voeg niewuwe organisator toe" zal deze div zichtbaar zijn -->
 <div id="newOrganisatorField" style="display: none;">
        <label for="newOrganisatorNaam">Nieuwe Organisator Naam:</label>
        <input type="text" id="newOrganisatorNaam" name="newOrganisatorNaam" placeholder="Organisator Naam">
        
        <label for="newOrganisatorFunctie">Functie:</label>
        <input type="text" id="newOrganisatorFunctie" name="newOrganisatorFunctie" placeholder="Functie">
</div>
<!-- --------------------------------------------------------------------------------- -->


    <button type="submit" name="update">Opslaan</button>
    <button type="submit" name="delete">Verwijderen</button>
</form>



 <!-- -------------------------- -->


    <h3>Deelnemers</h3>
    <table>
        <tr>
            <th>Naam</th>
            <th>email</th>
            <th>info</th>
            <th>Link</th>
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