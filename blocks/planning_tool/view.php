<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-block-wrapper">
    <div class="ccm-block-type-custom-block-field"><?= $content ?></div>

<?php   if ($choice == '') { ?>
    <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="set-choice" data-value="person" class="btn btn-primary">Persoon</a>
    &nbsp;&nbsp;&nbsp;
    <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="set-choice" data-value="expertise" class="btn btn-primary">Expertise</a>
<?php   } else { 
            if ($choice == 'person' && !isset($buttons)) { ?>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="personID" class="form-label">With who?</label>
                            <select id="personID" name="personID" class="form-select" data-href="<?php echo $view->action('PersonTS', Core::make('token')->generate('PersonTS'))?>">
                                <option value=""></option>
                                <?php foreach ($persons as $person){ ?>
                                    <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="choice" value="person">
                        </div>
                    </div>
                </div> 
<?php       }
            if ($choice == 'expertise' && !isset($buttons)) { ?>
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
                </div>
<?php       }
            if (isset($choice) && isset($buttons)) { ?>
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
                <div class="container mt-4">
                    <div class="d-flex align-items-start justify-content-between">
                        <?php foreach ($buttons as $date => $timeslot) { ?>
                            <div class="w-100 px-2 mb-3">
                                <div class="card rounded-top">
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
<?php       }
        } ?>
</div>


<script>
$(function() {
    $('a[data-action=set-choice]').on('click', function() {
        $.ajax({
            type: 'POST',
		    cache: false,
            data: { choice: $(this).data('value') },
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(response) {
                $('div.ccm-block-wrapper').replaceWith(response);
            }
        });
        return false;
    });

    $('select[name="personID"], select[name="expertiseID"]').on('change', function() {
        var PersonTS = $(this).val();
        var choice = $('input[name="choice"]').val(); // Ophalen van de waarde van de 'choice'-input

        $.ajax({
            type: 'POST',
            cache: false,
            data: { PersonTS: PersonTS, choice: choice }, // Verstuur ook de waarde van 'choice'
            url: $(this).data('href'),
            dataType: 'html',
            success: function(response) {
                $('div.ccm-block-wrapper').replaceWith(response);
            }
        });
    });
});
</script>

    

