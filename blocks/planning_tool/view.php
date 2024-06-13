<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>
<div class="ccm-block-wrapper">
    <div class="ccm-block-type-custom-block-field"><?= $content ?></div>
<?php   
        if ($choice == '') { ?>
        <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="set-choice" data-value="person" class="btn btn-danger">Persoon</a>
        &nbsp;&nbsp;&nbsp;
        <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="set-choice" data-value="expertise" class="btn btn-danger">Expertise</a>
    </div>
<?php   } else { 
            if ($choice == 'person' && !isset($buttons) && !isset($date)) { ?>
                <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="stepOne" data-value="null" class="btn btn-secondary mb-3 btn-sm">go back</a>
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
            if ($choice == 'expertise' && !isset($buttons) && !isset($date)) { ?>
                <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="stepOne" data-value="null" class="btn btn-secondary btn-sm mb-3">go back</a>
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
             <a href="<?php echo $view->action('personTS', Core::make('token')->generate('personTS'))?>" data-action="stepTwo" class="btn btn-secondary btn-sm mb-3">go back</a>
                <div class="col text-end"> 
                    <div class="form-group">
                        <div class="mt-3 pt-3 justify-content-between d-flex">
                            <a id="previousWeekBtn" href="javascript:;" class="btn btn-danger"><- previous week</a>
                            <a id="nextWeekBtn" href="javascript:;" class="btn btn-danger">next week -></a>
                        </div>
                    </div>
                </div>
                <div class="container mt-4 custom-timeslot">
                    <div class="d-flex justify-content-center custom-flex">
                        <?php foreach ($buttons as $date => $timeslot) { ?>
                            <div class="row">
                                <div class="col me-4">
                                    <div class="w-200 px-2 custom-slot" style="width: 225px;">
                                </div>
                                    <div class="card rounded-top">
                                        <div class="ps-3 pt-2 text-secondary font-weight-bold">
                                            <strong><?= date('l', strtotime($date)); ?><br/>
                                            <?= $date; ?></strong>
                                        </div>
                                        <div class="card-body">
                                            <?php if (isset($buttons[$date]) && !empty($timeslot)) { ?>
                                                <?php foreach ($timeslot as $button) { ?>
                                                    <div class="mb-1 d-flex align-items-center">
                                                        <a href="javascript:;" 
                                                            class="btn border-bottom text-danger btn-sm w-100 d-flex align-items-center custom-button set-appointment" 
                                                            data-personid="<?= $button['personID']; ?>" 
                                                            data-expertiseid="<?= isset($expertiseTS) ? $expertiseTS : 0; ?>"
                                                            data-date="<?= $date; ?>"
                                                            data-starttime="<?= $button['startTime']; ?>" 
                                                            data-endtime="<?= $button['endTime']; ?>">
                                                            <div class="rounded-circle text-success mr-2" style="width: 1rem; height: 1rem; background-color: #E30814;"></div>
                                                            <strong><span class="ms-2 text-secondary" style="font-size: 15px;"><?= $button['startTime'] . ' - ' . $button['endTime']; ?></span></strong>
                                                            <?php if ($choice == 'person'){ ?>
                                                                <input type="hidden" name="choice" value="person">
                                                                <input type="hidden" name="personID" id="personID">
                                                            <?php } ?>
                                                            <?php if ($choice == 'expertise'){ ?>
                                                                <input type="hidden" name="choice" value="expertise">
                                                                <input type="hidden" name="expertiseID" id="expertiseID">
                                                            <?php } ?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <p class="text-muted text-center">No time slots available for this day.</p>
                                            <?php } ?>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
<?php       }    
            if (isset($choice) && isset($startTime)) { ?>   
             <a href="<?php echo $view->action('appointmentt', Core::make('token')->generate('appointmentt'))?>" data-action="stepThree" class="btn btn-secondary mb-3 btn-sm">go back</a>
                <form method="post" action="<?php echo $view->action('saveAppointment', Core::make('token')->generate('saveAppointment'))?>">
                    <input type="hidden" name="choice" value="person">
                    <input type="hidden" name="choice" value="expertise">
                    <input type="hidden" id="personID" name="personID" value="<?= $personID ?>">
                    <input type="hidden" id="expertiseID" name="expertiseID" value="<?= $expertiseID ?>">
                    <input type="hidden" id="appointmentDatetime" name="appointmentDatetime" value="<?= $date ?>">
                    <input type="hidden" id="appointmentStartTime" name="appointmentStartTime" value="<?= $startTime ?>">
                    <input type="hidden" id="appointmentEndTime" name="appointmentEndTime" value="<?= $endTime ?>">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="" ><br>
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">lastname</label>
                            <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="" ><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="" ><br>
                        </div>
                        <div class="col">
                            <label for="number" class="form-label">Phone number</label>
                            <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="" ><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea id="appointmentComment" name="appointmentComment" class="form-control ccm-input-textarea"></textarea><br>
                        </div>
                    </div>
                    <div class="ccm-dashboard-form-actions-wrapper">
                        <div class="ccm-dashboard-form-actions">
                            <button class="btn btn-danger" type="submit">Versturen</button>
                        </div>
                    </div>
                </form>
            <?php } ?>
    <?php } ?>
</div>

<script>
$(document).ready(function() {
    $('.set-appointment').off().on('click', function(e) {
        e.preventDefault(); 

        var personID = $(this).data('personid');
        var expertiseID = $(this).data('expertiseid');


        $('#personID').val(personID);
        $('#expertiseID').val(expertiseID);

    });
});

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

    $('a[data-action=stepOne]').on('click', function() {
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

    $('a[data-action=stepTwo]').on('click', function() {
        var choice = $('input[name="choice"]').val();

        $.ajax({
            type: 'POST',
            cache: false,
            data: { personTS: null, expertiseTS: null, choice: choice }, 
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(response) {
                $('div.ccm-block-wrapper').replaceWith(response);
            }
        });
        return false;
    });
    
    $(document).ready(function() {
        $('.set-appointment').off().on('click', function(e) {
            e.preventDefault(); 

            var personID = $(this).data('personid');
            var expertiseID = $(this).data('expertiseid');
            var date = $(this).data('date');
            var startTime = $(this).data('starttime');
            var endTime = $(this).data('endtime');
            var choice = $('input[name="choice"]').val();
            
            $.ajax({
                type: 'POST', 
                url: '<?php echo $view->action('appointment', Core::make('token')->generate('appointment')); ?>',
                data: { personID: personID, expertiseID: expertiseID, date: date, startTime: startTime, endTime: endTime, choice: choice },
                dataType: 'html',
                success: function(response) {
                    $('div.ccm-block-wrapper').replaceWith(response);
                },
            });
        }); 
    });

    $('a[data-action=stepThree]').on('click', function(e) {
        e.preventDefault();

        var choice = $('input[name="choice"]').val(); 
        var personTS = $('input[name="personID"]').val(); 
        var expertiseTS = $('input[name="expertiseID"]').val(); 

        $.ajax({
            type: 'POST', 
            url: $(this).attr('href'),
            data: { 
                personTS: personTS,
                expertiseTS: expertiseTS,
                choice: choice 
            },
            dataType: 'html',
            success: function(response) {
                $('div.ccm-block-wrapper').replaceWith(response);
            },
        });
    });

    $(document).ready(function() {
        var weekOffset = <?= $weekOffset ?>;
        var personTS = <?= ((isset($personTS) && $personTS!='')?$personTS:'0'); ?>;
        var expertiseTS = <?= ((isset($expertiseTS) && $expertiseTS!='')?$expertiseTS:'0'); ?>;

        $("#previousWeekBtn").click(function(event) {
            if (weekOffset > 0) { 
                weekOffset--;
                updateWeekOffset();
            }
        });

        $("#nextWeekBtn").click(function(event) {
            event.preventDefault();
            weekOffset++;
            updateWeekOffset();
        });

        function updateWeekOffset() {
            $.ajax({
                url: '<?php echo $view->action('weeks', Core::make('token')->generate('weeks')) ?>',
                type: 'POST',
                data: { personTS: personTS, expertiseTS: expertiseTS, weekOffset: weekOffset, choice: $('input[name="choice"]').val() },
                success: function(response) {
                    $('div.ccm-block-wrapper').replaceWith(response);
                },
            });
        }
    });
});

$(document).ready(function() {
    var formSubmitted = false;

    $('form').submit(function(event) {
        event.preventDefault(); 

        if (formSubmitted) {
            return;
        }

        if (!validateForm()) {
            return;
        }

        formSubmitted = true; 
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '<?php echo $view->action('saveAppointment', Core::make('token')->generate('saveAppointment')) ?>',
            data: formData,
            success: function(response) {
                var appointmentName = $('#appointmentName').val();
                var appointmentLastname = $('#appointmentLastname').val();
                var appointmentDatetime = $('#appointmentDatetime').val();
                var appointmentStartTime = $('#appointmentStartTime').val();
                var appointmentEndTime = $('#appointmentEndTime').val();

                var message = 'You have successfully made an appointment on ' + appointmentDatetime + ' from ' + appointmentStartTime + ' to ' + appointmentEndTime + '.';
                alert(message);

                $('form')[0].reset();
                formSubmitted = false; 
                $('div.ccm-block-wrapper').html(response);
            },
            error: function(xhr, status, error) {
                alert('Er is een fout opgetreden bij het verwerken van het formulier: ' + error);
                formSubmitted = false; 
            }
        });
    });

    function validateForm() {
        var appointmentName = $('#appointmentName').val().trim();
        var appointmentLastname = $('#appointmentLastname').val().trim();
        var appointmentEmail = $('#appointmentEmail').val().trim();
        var appointmentPhone = $('#appointmentPhone').val().trim();
        var appointmentDatetime = $('#appointmentDatetime').val().trim();
        var appointmentStartTime = $('#appointmentStartTime').val().trim();
        var appointmentEndTime = $('#appointmentEndTime').val().trim();

        if (appointmentName === '') {
            alert('Please enter your name.');
            formSubmitted = false; 
            return false;
        }

        if (appointmentLastname === '') {
            alert('Please enter your last name.');
            formSubmitted = false; 
            return false;
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(appointmentEmail)) {
            alert('Please enter a valid email address.');
            formSubmitted = false; 
            return false;
        }

        var phonePattern = /^\d{10}$/;
        if (!phonePattern.test(appointmentPhone)) {
            alert('Please enter a valid 10-digit phone number.');
            formSubmitted = false; 
            return false;
        }

        if (appointmentDatetime === '' || appointmentStartTime === '' || appointmentEndTime === '') {
            alert('Please enter appointment date and time.');
            formSubmitted = false; 
            return false;
        }

        return true;
    }
});
</script>
<style>
.btn-danger {
    color: #fff;
    background-color: #E30814;
}
</style>

    

