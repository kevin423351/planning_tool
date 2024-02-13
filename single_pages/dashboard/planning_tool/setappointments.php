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
        <?php foreach ($timeslots as $timeslot){?>
            <div class="w-100 px-2 mb-3">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <strong><?= $timeslot->getday(); ?></strong><br/>August 23
                    </div>
                    <div class="card-body">
                    <?php
                        $startTime = new DateTime($timeslot->getStartTime());
                        $endTime = new DateTime($timeslot->getEndTime());

                        // Loop door de blokken van 30 minuten
                        while ($startTime < $endTime) {
                            $blockEndTime = clone $startTime;
                            $blockEndTime->add(new DateInterval('PT30M')); // Voeg 30 minuten toe aan de starttijd

                            // Toon de blokken als buttons
                        ?>
                        <ul id="timeslotList" class="list-group-item border border-top-0 shadow-sm mb-1">
                            <a href="<?= URL::to('/dashboard/planning_tool/appointments/', ['startTime' => $startTime->format('H:i'), 'endTime' => $blockEndTime->format('H:i')]); ?>" class="btn btn-sm text-center">
                               <?= $startTime->format('H:i') . ' - ' . $blockEndTime->format('H:i'); ?>
                            </a>
                        </ul>
                        <?php
                        $startTime = $blockEndTime; // Update de starttijd voor het volgende blok
                        }
                        ?>
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
