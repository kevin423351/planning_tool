<?php if ($this->controller->getAction() == 'view') { ?>
    <form method="post" action="<?=$this->action('save')?>">
        <div class="form-group">
            <label for="personID">Select Person:</label>
            <select class="form-select" name="personID" required>
                <?php foreach ($persons as $person) { ?>
                    <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                <?php } ?>
            </select>
            <div class="help-block">select the person that is unavailable</div>
        </div>
        

        <div class="form-group">
            <label for="unavailableDate">Date:</label>
            <input class="form-control ccm-input-date hasDatepicker" type="date" id="unavailableDate" name="unavailableDate" required>
        </div>
        <div class="form-group">
            <label for="unavailableStarttime">Start Time:</label>
            <input class="form-control ccm-input-time" type="time" id="unavailableStarttime" name="unavailableStarttime" required>
        </div>
        <div class="form-group">
            <label for="unavailableEndtime">End Time:</label>
            <input class="form-control ccm-input-time" type="time" id="unavailableEndtime" name="unavailableEndtime" required>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">save</button>
    </form>
<?php } ?>
