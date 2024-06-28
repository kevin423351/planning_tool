<?php if ($this->controller->getAction() == 'view') { ?>
    <form method="post" action="<?= $this->action('save') ?>">
        <div class="form-group">
            <label for="personID">Select Person:</label>
                <select class="form-select" name="personID[]" multiple required>
                    <option value="all">Select all persons</option>
                    <?php foreach ($persons as $person) { ?>
                        <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                    <?php } ?>
                </select>
            <div class="help-block">"Select the person that is unavailable."</div>
        </div><br>
        <div class="form-group">
            <label for="unavailableOption">Unavailable Option:</label>
            <select class="form-select" name="unavailableOption" id="unavailableOption" required>
                <option value="specific_date">Specific Date and Time</option>
                <option value="whole_day">Whole Day</option>
                <option value="date_range">Date Range</option>
            </select>
            <div class="help-block">"Select the unavailable option."</div>
        </div>
        <div class="row" id="specificDate">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="unavailableDate">Date:</label>
                    <input class="form-control hasDatepicker" type="date" id="unavailableDate" name="unavailableDate">
                </div>
            </div>
            <div class="col-12 col-md-4">   
                <div class="form-group">
                    <label for="unavailableStartTime">Start Time:</label>
                    <input class="form-control ccm-input-time" type="time" id="unavailableStartTime" name="unavailableStartTime">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="unavailableEndTime">End Time:</label>
                    <input class="form-control ccm-input-time" type="time" id="unavailableEndTime" name="unavailableEndTime">
                </div>
            </div>
        </div>
        <div class="row" id="wholeDay">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="wholeDayDate">Date:</label>
                    <input class="form-control hasDatepicker" type="date" id="wholeDayDate" name="wholeDayDate">
                </div>
            </div>
        </div>
        <div class="row" id="dateRange">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="startDate">Start Date:</label>
                    <input class="form-control hasDatepicker" type="date" id="startDate" name="startDate">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="endDate">End Date:</label>
                    <input class="form-control hasDatepicker" type="date" id="endDate" name="endDate">
                </div>
            </div>
        </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions ">
                <button class="float-end btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            const $specificDate = $('#specificDate');
            const $wholeDay = $('#wholeDay');
            const $dateRange = $('#dateRange');
            const $unavailableOption = $('#unavailableOption');

            $specificDate.show();
            $wholeDay.hide();
            $dateRange.hide();

            $unavailableOption.on('change', function() {
                const selectedOption = $(this).val();
                if (selectedOption === 'specific_date') {
                    $specificDate.show();
                    $wholeDay.hide();
                    $dateRange.hide();
                } else if (selectedOption === 'whole_day') {
                    $specificDate.hide();
                    $wholeDay.show();
                    $dateRange.hide();
                } else if (selectedOption === 'date_range') {
                    $specificDate.hide();
                    $wholeDay.hide();
                    $dateRange.show();
                }
            });
        });
    </script>
<?php } ?>
