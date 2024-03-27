<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-block-type-custom-block-field"><?= $content ?></div>

<!-- De knop met een identificerend attribuut -->
<a href="#" id="showContentButton" class="btn btn-primary btn-sm">personen</a>

<!-- De container voor de inhoud die wordt weergegeven na het klikken op de knop -->
<div id="contentToInsert" style="display: none;">
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
                                        <a href="<?= URL::to('/dashboard/planning_tool/setappointments/appointment', $personID, isset($expertiseID) ? $expertiseID : 0, $date, str_replace(':', '-', $button['startTime']), str_replace(':', '-', $button['endTime'])); ?>" class="btn border-bottom text-primary btn-sm w-100 d-flex align-items-center custom-button">
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
</div>
 
<script>
$(document).ready(function() {
    // Luister naar het klikken op de knop
    $('#showContentButton').click(function(event) {
        event.preventDefault(); // Voorkom standaardgedrag van de link
        
        // Laat de inhoud van #contentToInsert zien
        $('#contentToInsert').show();
    });
});
</script>
    

