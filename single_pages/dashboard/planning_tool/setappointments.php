<?php if ($this->controller->getAction() == 'view') { ?>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/personview')?>" class="btn btn-primary btn-sm">personen</a>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/expertiseview')?>" class="btn btn-primary btn-sm">expertises</a>
<?php } else if ($this->controller->getAction() == 'personview') { ?>

<div class="form-group">
    <label for="personID" class="form-label">With who?</label>
    <select id="personID" name="personID" class="form-select">
        <?php foreach ($persons as $person): ?>
            <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="container mt-4">
    <div class="d-flex align-items-start justify-content-between">
        <?php foreach ($buttons as $date => $timeslot) { ?>
            <div class="w-100 px-2 mb-3">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <strong><?= date('l', strtotime($date)); ?></strong><br/>  
                        <?= $date; ?>
                    </div>
                    <div class="card-body">
                        <?php if (isset($buttons[$date])) { ?>
                            <?php foreach ($timeslot as $button){ ?>
                                <ul id="timeslotList" class="list-group-item border border-top-0 shadow-sm mb-1">
                                    <a href="<?= URL::to('/dashboard/planning_tool/appointments/', ['startTime' => $button['startTime'], 'endTime' => $button['endTime']]); ?>" class="btn btn-sm text-center">
                                        <?= $button['startTime'] . ' - ' . $button['endTime']; ?>
                                    </a>
                                </ul>
                            <?php } ?>
                        <?php } else { ?>
                            <p>No time slots available for this day.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php } else if ($this->controller->getAction() == 'expertiseview') { ?> 
<?php } ?>

<script>
    $(document).ready(function () {
        $('select[name="personID"]').on('change', function() {
            window.location.href = '<?=$this->action('personview');?>/'+$(this).val();
        });
    });
</script>


