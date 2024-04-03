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
                            <select id="personID" name="personID" class="form-select" data-href="<?php echo $view->action('personTS', Core::make('token')->generate('personTS'))?>">
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
                            <select id="expertiseID" name="expertiseID" class="form-select" data-href="<?php echo $view->action('personTS', Core::make('token')->generate('personTS'))?>">
                                <option value=""></option>
                                <?php foreach ($expertises as $expertise){ ?>
                                    <option value="<?= $expertise->getItemID(); ?>"><?= $expertise->getFirstname(); ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="choice" value="expertise">
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
                                                    <a href="javascript:;" 
                                                        class="btn border-bottom text-primary btn-sm w-100 d-flex align-items-center custom-button set-appointment" 
                                                        data-personid="<?= $button['personID']; ?>" 
                                                        data-expertiseid="<?= isset($expertiseID) ? $expertiseID : 0; ?>"
                                                        data-date="<?= $date; ?>"
                                                        data-start="<?= str_replace(':', '-', $button['startTime']); ?>" 
                                                        data-end="<?= str_replace(':', '-', $button['endTime']); ?>">
                                                        <div class="rounded-circle text-primary mr-2" style="width: 1rem; height: 1rem; background-color: #007BFF;"></div>
                                                        <span class="ms-2"><?= $button['startTime'] . ' - ' . $button['endTime']; ?></span>
                                                        <input type="hidden" name="choice" value="person">
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
                if (isset($choice) && isset($buttons)) { ?>
                <?php wtfs($button['startTime']); ?>
                    <form method="post" action="">
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
                                <label for="comment" class="form-label">comment</label>
                                <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value=""><br>
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
    <?php } ?>
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
        var personTS = $('select[name="personID"]').val(); 
        var expertiseTS = $('select[name="expertiseID"]').val(); 
        var choice = $('input[name="choice"]').val();

        $.ajax({
            type: 'POST',
            cache: false,
            data: { personTS: personTS, expertiseTS: expertiseTS, choice: choice },
            url: $(this).data('href'),
            dataType: 'html',
            success: function(response) {
                $('div.ccm-block-wrapper').replaceWith(response);
            }
        });
    });
    
    $(document).ready(function() {
        $('.set-appointment').click(function(e) {
            e.preventDefault(); 

            var personID = $(this).data('personid');
            var expertiseID = $(this).data('expertiseid');
            var date = $(this).data('date');
            var startTime = $(this).data('start');
            var endTime = $(this).data('end');

            $.ajax({
                type: 'POST', 
                url: '<?php echo $view->action('appointment', Core::make('token')->generate('appointment')); ?>',
                data: { personID: personID, expertiseID: expertiseID, date: date, startTime: startTime, endTime: endTime },
                dataType: 'html',
                success: function(response) {
                    $('div.ccm-block-wrapper').replaceWith(response);
                },
            });
        });
    });
});
</script>

    

