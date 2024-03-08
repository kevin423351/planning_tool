<?php if ($this->controller->getAction() == 'view') { ?>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/personview')?>" class="btn btn-primary btn-sm">personen</a>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/expertiseview')?>" class="btn btn-primary btn-sm">expertises</a>
<?php } else if ($this->controller->getAction() == 'personview') { ?>

<div class="form-group">
    <label for="personID" class="form-label">With who?</label>
    <select id="personID" name="personID" class="form-select">
        <?php foreach ($persons as $person){ ?>
            <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
        <?php } ?>
    </select>
</div>

<div class="container mt-4">
    <div class="d-flex align-items-start justify-content-between">
        <?php foreach ($buttons as $date => $timeslot) { ?>
            <div class="w-100 px-2 mb-3">
                <div class="card border-dark rounded-top">
                    <div class="card-header bg-primary text-white text-center font-weight-bold">
                        <?= date('l', strtotime($date)); ?><br/>
                        <?= $date; ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($buttons[$date]) && !empty($timeslot)) { ?>
                            <?php foreach ($timeslot as $button) { ?>
                                <div class="mb-2 border-top-0">
                                    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/appointment', $personID, $date, str_replace(':', '-', $button['startTime']), str_replace(':', '-', $button['endTime'])); ?>" class="btn btn-outline-dark btn-sm w-100">
                                        <?= $button['startTime'] . ' - ' . $button['endTime']; ?>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="text-muted text-center">No time slots available for this day.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php } else if ($this->controller->getAction() == 'appointment') { ?> 
    <form method="post" action="<?=$this->action('saveAppointment')?>">

      <input type="hidden" id="personID" name="personID" value="<?= $personID ?>">
      <input type="hidden" id="expertiseID" name="expertiseID" value="<?= $expertiseID ?>">
      <input type="hidden" id="appointmentDatetime" name="appointmentDatetime" value="<?= $date ?>">
      <input type="hidden" id="appointmentStartTime" name="appointmentStartTime" value="<?= $start ?>">
      <input type="hidden" id="appointmentEndTime" name="appointmentEndTime" value="<?= $end ?>">

      <label for="name" class="form-label">Name</label>
      <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="" required><br>

      <label for="date" class="form-label">Date of birth</label>
      <input type="text" id="appointmentDate" name="appointmentDate" class="form-control ccm-input-text" value=""><br>

      <label for="number" class="form-label">Phone number</label>
      <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="" required><br>

      <label for="comment" class="form-label">comment</label>
      <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value=""><br>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
    </form>
<?php } else if ($this->controller->getAction() == 'expertiseview') { ?> 
<div class="form-group">
    <label for="expertiseID" class="form-label">With who?</label>
    <select id="expertiseID" name="expertiseID" class="form-select">
        <?php foreach ($expertises as $expertise){ ?>
            <option value="<?= $expertise->getItemID(); ?>"><?= $expertise->getFirstname(); ?></option>
        <?php } ?>
    </select>
</div>

<div class="container mt-4">
    <div class="d-flex align-items-start justify-content-between">
        <?php foreach ($buttons as $date => $timeslot) { ?>
            <div class="w-100 px-2 mb-3">
                <div class="card border-dark rounded-top">
                    <div class="card-header bg-primary text-white text-center font-weight-bold">
                        <?= date('l', strtotime($date)); ?><br/>
                        <?= $date; ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($buttons[$date]) && !empty($timeslot)) { ?>
                            <?php foreach ($timeslot as $button) { ?>
                                <div class="mb-1">
                                    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/appointment', $personID, $expertiseID, $date, str_replace(':', '-', $button['startTime']), str_replace(':', '-', $button['endTime'])); ?>" class="btn btn-outline-primary btn-sm w-100">
                                        <?= $button['startTime'] . ' - ' . $button['endTime']; ?>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <p class="text-muted text-center">No time slots available for this day.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?> 
    </div>
</div>

<?php } ?> 

<script>
    $(document).ready(function () {
        $('select[name="personID"]').on('change', function() {
            window.location.href = '<?=$this->action('personview');?>/'+$(this).val();
        });
    });
    $(document).ready(function () {
        $('select[name="expertiseID"]').on('change', function() {
            window.location.href = '<?=$this->action('expertiseview');?>/'+$(this).val();
        });
    });
</script>


