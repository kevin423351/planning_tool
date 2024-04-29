<?php if ($this->controller->getAction() == 'view') { ?>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/personview')?>" class="btn btn-primary btn-sm">personen</a>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/expertiseview')?>" class="btn btn-primary btn-sm">expertises</a>
<?php } else if ($this->controller->getAction() == 'personview') { ?>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="personID" class="form-label">With who?</label>
            <select id="personID" name="personID" class="form-select">
                <?php foreach ($persons as $person){ ?>
                    <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col text-end"> 
        <div class="form-group">
            <div class="mt-3 pt-3">
                <?php
                $lastWeekOffset = $weekOffset - 1;
                $nextWeekOffset = $weekOffset + 1;
                ?>
                <a href="<?= URL::to('/dashboard/planning_tool/setappointments/personview/' . $personID . '/' . $lastWeekOffset) ?>" class="btn btn-primary"><- previous week</a>
                <a href="<?= URL::to('/dashboard/planning_tool/setappointments/personview/' . $personID . '/' . $nextWeekOffset) ?>" class="btn btn-primary">next week -></a>
            </div>
        </div>
    </div>
</div> 

<div class="container mt-4 custom-timeslot">
    <div class="d-flex align-items-start justify-content-between">
        <?php foreach ($buttons as $date => $timeslot) { ?>
            <div class="w-100 px-2 mb-3 custom-timeslot">
                <div class="card border-dark rounded-top">
                    <div class="ps-3 pt-2 text-primary font-weight-bold">
                        <?= date('l', strtotime($date)); ?><br/>
                        <?= $date; ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($buttons[$date]) && !empty($timeslot)) { ?>
                            <?php foreach ($timeslot as $button) { ?>
                                <div class="mb-1 d-flex align-items-center">
                                    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/appointment', $button['personID'], isset($expertiseID) ? $expertiseID : 0, $date, str_replace(':', '-', $button['startTime']), str_replace(':', '-', $button['endTime'])); ?>" class="btn border-bottom text-primary btn-sm w-100 d-flex align-items-center custom-button">
                                        <div class="rounded-circle text-primary mr-2" style="width: 1rem; height: 1rem; background-color: #007BFF;"></div>
                                        <span class="ms-2"><?= $button['startTime'] . ' - ' . $button['endTime']; ?></span>
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
        <div class="row">
            <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="" required><br>
            </div>
            <div class="col">
                <label for="lastname" class="form-label">lastname</label>
                <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="" required><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="" required><br>
            </div>
            <div class="col">
                <label for="number" class="form-label">Phone number</label>
                <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="" required><br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="comment" class="form-label">Comment</label>
                <textarea id="appointmentComment" name="appointmentComment" class="form-control ccm-input-textarea"></textarea><br>
            </div>
        </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions ">
                <a href="#" class="btn btn-secondary float-start">Cancel</a>
                <button class="float-end btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </form>
<?php } else if ($this->controller->getAction() == 'expertiseview') { ?> 

<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="expertiseID" class="form-label">With who?</label>
            <select id="expertiseID" name="expertiseID" class="form-select">
                <?php foreach ($expertises as $expertise){ ?>
                    <option value="<?= $expertise->getItemID(); ?>"><?= $expertise->getFirstname(); ?></option>
                <?php } ?>
            </select>
        </div> 
    </div>
    <div class="col text-end">
        <div class="form-group">
            <div class="mt-3 pt-3">
                <?php
                $lastWeekOffset = $weekOffset - 1;
                $nextWeekOffset = $weekOffset + 1;
                ?>
                <a href="<?= URL::to('/dashboard/planning_tool/setappointments/expertiseview/' . $expertiseID . '/' . $lastWeekOffset) ?>" class="btn btn-primary"><- previous week</a>
                <a href="<?= URL::to('/dashboard/planning_tool/setappointments/expertiseview/' . $expertiseID . '/' . $nextWeekOffset) ?>" class="btn btn-primary">next week -></a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="d-flex align-items-start justify-content-between">
        <?php foreach ($buttons as $date => $timeslot) { ?>
            <div class="w-100 px-2 mb-3">
                <div class="card border-dark rounded-top">
                    <div class="ps-3 pt-2 text-primary font-weight-bold">
                        <?= date('l', strtotime($date)); ?><br/>
                        <?= $date; ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($buttons[$date]) && !empty($timeslot)) { ?>
                            <?php foreach ($timeslot as $button) { ?>
                                <div class="mb-1 d-flex align-items-center">
                                    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/appointment', $button['personID'], $expertiseID, $date, str_replace(':', '-', $button['startTime']), str_replace(':', '-', $button['endTime'])); ?>" class="btn border-bottom text-primary btn-sm w-100 d-flex align-items-center custom-button">
                                        <div class="rounded-circle text-primary mr-2" style="width: 1rem; height: 1rem; background-color: #007BFF;"></div>
                                        <span class="ms-2"><?= $button['startTime'] . ' - ' . $button['endTime']; ?></span>
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
<style>
    @media (max-width: 576px) {
        .custom-timeslot {
            /* display: block; */
            width: 100px;
        }
    }
  .custom-button {
    color: #4a90e2;
    background-color: #fff;
  }

  .custom-button:hover {
    background-color: #d0e6ff;
    color: #fff;
  }

  .custom-button:focus {
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.5);
  }

  .custom-button:active {
    background-color: #4a90e2;
    color: #fff;
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
  }

  .custom-button:disabled {
    color: #4a90e2;
    background-color: transparent;
    border-color: #4a90e2;
  }
  .text-end {
    text-align: end;
  }
</style>

