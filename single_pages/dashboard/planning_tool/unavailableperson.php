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
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="unavailableStarttime">Start Time:</label>
                    <input class="form-control ccm-input-time" type="time" id="unavailableStarttime" name="unavailableStarttime" required>
                </div>
                <div class="help-block">"Select the start time that someone is not available."</div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="unavailableEndtime">End Time:</label>
                    <input class="form-control ccm-input-time" type="time" id="unavailableEndtime" name="unavailableEndtime" required>
                </div>
                <div class="help-block">"Select the end time that someone is not available."</div>
            </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions ">
                <a href="#" class="btn btn-secondary float-start">Cancel</a>
                <button class="float-end btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
<?php } ?>
