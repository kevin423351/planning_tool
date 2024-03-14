<?php if ($this->controller->getAction() == 'view') { ?>
    <form method="post" action="<?=$this->action('save')?>">
        <div class="form-group">
            <label for="personID">Select Person:</label>
            <select class="form-select" name="personID" required>
                <option value="all">Select all persons</option>
                <?php foreach ($persons as $person) { ?>
                    <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                <?php } ?>
            </select>
            <div class="help-block">"select the person that is unavailable."</div>
        </div><br><br>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="unavailableDate">Date:</label>
                    <input class="form-control hasDatepicker" type="date" id="unavailableDate" name="unavailableDate" required>
                </div>
                <div class="help-block">"Select the date that someone is unavailable."</div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="unavailableStarttime">Start Time:</label>
                    <input class="form-control ccm-input-time" type="time" id="unavailableStarttime" name="unavailableStarttime" required>
                </div>
                <div class="help-block">"Select the start time."</div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="unavailableEndtime">End Time:</label>
                    <input class="form-control ccm-input-time" type="time" id="unavailableEndtime" name="unavailableEndtime" required>
                </div>
                <div class="help-block">"Select the end time."</div>
            </div>
        </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions ">
                <a href="#" class="btn btn-secondary float-start">Cancel</a>
                <button class="float-end btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
<?php } ?>
