<?php
    /** @var $building ?\App\Model\Building */
?>

<div class="form-group">
    <label for="name">Nazwa</label>
    <input type="text" id="name" name="building[name]" value="<?= $building ? $building->getName() : '' ?>">
</div>

<div class="form-group">
    <label for="street">Ulica</label>
    <input type="text" id="street" name="building[street]" value="<?= $building ? $building->getStreet() : '' ?>">
</div>

<div class="form-group">
    <label for="number">Numer budynku</label>
    <input type="text" id="number" name="building[number]" value="<?= $building ? $building->getNumber() : '' ?>">
</div>

<div class="form-group">
    <label for="postCode">Kod pocztowy</label>
    <input type="text" id="postCode" name="building[postCode]" value="<?= $building ? $building->getPostCode() : '' ?>">
</div>

<div class="form-group">
    <label for="city">Miasto</label>
    <input type="text" id="city" name="building[city]" value="<?= $building ? $building->getCity() : '' ?>">
</div>

<div class="form-group">
    <label for="latitude">Szerokość geograficzna</label>
    <input type="text" id="latitude" name="building[latitude]" value="<?= $building ? $building->getLatitude() : '' ?>">
</div>

<div class="form-group">
    <label for="longitude">Długość geograficzna</label>
    <input type="text" id="longitude" name="building[longitude]" value="<?= $building ? $building->getLongitude() : '' ?>">
</div>

<!-- do zrobienia 
<div class="form-group">
    <label for="image">Zdjęcie</label>
    <input type="file" id="image" name="building[image]">
</div>
-->

<div class="form-group">
    <label></label>
    <input type="submit" value="Zatwierdź">
</div>
