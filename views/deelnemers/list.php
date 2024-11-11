<form method="POST" enctype="multipart/form-data">
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
        <label for="image">Image:</label>
        <br>
        <input type="file" name="image" id="image" accept="image/*">
        <br>
        <button type="submit" name="create">Opslaan</button>
    </form>

<h1>Deelnemers in het systeem</h1>
<form method="get">
    <input type="text" name="search" placeholder="Zoekterm" value="">
    <div style="display: flex; justify-content: flex-start; align-items: center; width: auto;">
        <label for="filter-image" style="margin-right: 10px;">Zonder afbeelding:</label>
        <input type="checkbox" name="filter_image" id="filter-image" <?php echo isset($_GET['filter_image']) ? 'checked' : ''; ?> style="flex-shrink: 0; width: auto;">
    </div>


    <label for="sort">Sorteer op:</label>
    <select name="sort" id="sort">
        <option value="naam" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'naam' ? 'selected' : ''; ?>>Naam</option>
        <option value="voornaam" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'voornaam' ? 'selected' : ''; ?>>Voornaam</option>
        <option value="email" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'email' ? 'selected' : ''; ?>>Email</option>
    </select>
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