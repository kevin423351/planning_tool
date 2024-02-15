<?php if ($this->controller->getAction() == 'view') { ?>
    <form method="post" action="<?=$this->action('save')?>">
        <div class="form-group">
            <label for="personID">Select Person:</label>
            <select name="personID" required>
                <?php foreach ($persons as $person) { ?>
                    <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="unavailableDate">Date:</label>
            <input type="date" id="unavailableDate" name="unavailableDate" required>
        </div>
        <div class="form-group">
            <label for="unavailableStarttime">Start Time:</label>
            <input type="time" id="unavailableStarttime" name="unavailableStarttime" required>
        </div>
        <div class="form-group">
            <label for="unavailableEndtime">End Time:</label>
            <input type="time" id="unavailableEndtime" name="unavailableEndtime" required>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">unavailable</button>
    </form>
<?php } ?>
