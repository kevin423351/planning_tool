<script>
   var _tmp = -1;
</script>
<?php if ($this->controller->getAction() == 'view') { ?>
<div class="ccm-dashboard-header-buttons">
   <a href="<?= URL::to('/dashboard/planning_tool/persons/add')?>" class="btn btn-success btn-sm">Add new</a>
</div>
<div class="table-responsive">
    <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
        <thead>
            <tr>
                <th class="">Name</th>
                <th class="">Lastname</th>
                <th class="">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($persons)) {
                foreach ($persons as $person) { ?>
                    <tr data-launch-search-menu="" class="">
                        <td><?=$person->getFirstname(); ?></td>
                        <td><?=$person->getLastname(); ?></td>
                        <td><?=$person->getEmail(); ?></td>
                        <td align="right">
                            <div class="btn-group" role="group">
                                <a href="<?= URL::to('/dashboard/planning_tool/persons/edit', $person->getItemID()); ?>" class="btn btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= URL::to('/dashboard/planning_tool/persons/delete', $person->getItemID()); ?>" class="btn btn-sm">
                                    <i class="fas fa-trash-alt"></i> 
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="5" class="text-center">No data found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php } else if ($this->controller->getAction() == 'add') { ?>
<h2>Add person</h2>
<form method="post" action="<?=$this->action('save')?>">
   <div class="row">
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="name" class="form-label">Name</label><input type="text" id="formName" name="formName" class="form-control ccm-input-text" value="" required><br>                        
         </div>
      </div>
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="lastname" class="form-label">lastname</label><input type="text" id="formLastname" name="formLastname" class="form-control ccm-input-text" value="" required><br>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="email" class="form-label">Email</label><input type="email" id="formEmail" name="formEmail" class="form-control ccm-input-text" value="" required><br>
         </div>
      </div>
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="date" class="form-label">Date of birth</label><input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value=""><br>
         </div>
      </div>
   </div>
   <label for="expertise" class="form-label">Expertises</label>
   <hr>
   <div class="row">
   <?php
      if (!empty($expertises)) {
         foreach ($expertises as $expertise) { ?>
            <div class="col-6 col-sm-2">
               <div class="form-group">
                  <input type="checkbox" name="expertise[]" class="form-check-input" value="<?=$expertise->getItemID(); ?>">
                  <label for="expertise" class="form-label"><?=$expertise->getFirstname(); ?></label>
               </div>
            </div>
   <?php }}?>
   </div>
   <label for="expertise" class="form-label">time slots</label>
   <hr>
   <div class="">
      <div class="">
         <div class=""><?=t('timeslot(s)');?></div>
      </div>
      <div class="">
         <div class="timeslots">
            <?php
               $timeslots = isset($person)?$person->getTimeslots():[];
               if (!count($timeslots)) {
                  $timeslots = ['-1' => []];
               }
               foreach ($timeslots as $key => $timeslot) {
                  
               ?>
            <div class="timeslot">
               <div class="col-auto">
                  <div class="input-group-append" style="margin-top:22px;">
                     <button class="btn btn-danger remove_timeslot" type="button" <?=!count($timeslots)?'disabled':'';?>>
                     <i class="icon-trash mr-0"></i>
                     </button>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsDays"><?=t('day');?></label>
                        <?=$form->select('timeslotsDays['.$key.']', $daysAssoc, $timeslot?$timeslot->getDay():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsStartTime"><?=t('Start time');?></label>
                        <?=$form->time('timeslotsStartTime['.$key.']', $timeslot?$timeslot->getStartTime():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsEndTime"><?=t('End time');?></label>
                        <?=$form->time('timeslotsEndTime['.$key.']', $timeslot?$timeslot->getEndTime():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="appointmentTime"><?=t('Appointment time');?></label>
                        <?=$form->number('appointmentTime['.$key.']', $timeslot?$timeslot->getAppointmentTime():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php } ?>
         <div class="form-group text-right">
            <button class="btn btn-primary add_timeslot" type="button">
            <i class="icon-plus mr-0"></i> <?=t('Add new');?>
            </button>
         </div>
         <script id="timeslot" type="text/template">
            <div class="timeslot">
               <div class="col-auto">
                  <div class="input-group-append" style="margin-top:22px;">
                     <button class="btn btn-danger remove_timeslot" type="button">
                         <i class="icon-trash mr-0"></i>
                     </button>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsDays"><?=t('day');?></label>
                        <?=$form->select('timeslotsDays[_tmp]', $daysAssoc, $timeslot?$timeslot->getDay():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">   
                     <div class="form-group">
                        <label for="timeslotsStartTime"><?=t('Start time');?></label>
                        <?=$form->time('timeslotsStartTime[_tmp]', '', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsEndTime"><?=t('End time');?></label>
                        <?=$form->time('timeslotsEndTime[_tmp]', '', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="appointmentTime"><?=t('Appointment time');?></label>
                        <?=$form->number('appointmentTime[_tmp]', '', ['data-required' => 'all']);?>
                     </div>
                  </div>
               </div>
            </div>
         </script>
      </div>
   </div>
   </div>
   <div class="ccm-dashboard-form-actions-wrapper">
      <div class="ccm-dashboard-form-actions ">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </div>
</form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
<h2>Edit persons</h2>
<form method="post" action="<?=$this->action('save', $person->getItemID()); ?>">
   <div class="row">
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="name" class="form-label">Name</label><input type="text" id="formName" name="formName" class="form-control ccm-input-text" value="<?=$person->getFirstname(); ?>" required><br>                        
         </div>
      </div>
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="lastname" class="form-label">lastname</label><input type="text" id="formLastname" name="formLastname" class="form-control ccm-input-text" value="<?=$person->getLastname(); ?>" required><br>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="email" class="form-label">Email</label><input type="email" id="formEmail" name="formEmail" class="form-control ccm-input-text" value="<?=$person->getEmail(); ?>" required><br>
         </div>
      </div>
      <div class="col-12 col-md-6">
         <div class="form-group">
            <label for="date" class="form-label">Date of birth</label><input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value="<?=$person->getDate(); ?>"><br>
         </div>
      </div>
   </div>
   <label for="expertise" class="form-label">Expertises</label>
   <hr>
   <div class="row">
   <?php
      if (!empty($expertises)) {
         foreach ($expertises as $expertise) { ?>
            <div class="col-6 col-sm-2">
               <div class="form-group">
                  <input type="checkbox" name="expertise[]" class="form-check-input" value="<?=$expertise->getItemID(); ?>" <?=($person->hasExpertise($expertise)) ? 'checked' : ''; ?>>
                  <label for="expertise" class="form-label"><?=$expertise->getFirstname(); ?></label>
               </div>
            </div>
   <?php }}?>
   </div>
   <label for="expertise" class="form-label">time slots</label>
   <hr>
   <div class="">
      <div class="">
         <div class=""><?=t('timeslot(s)');?></div>
      </div>
      <div class="">
         <div class="timeslots">
            <?php 
               foreach ($timeslots as $key => $timeslot) {
               ?>
            <div class="timeslot">
               <div class="col-auto">
                  <div class="input-group-append" style="margin-top:22px;">
                     <button class="btn btn-danger remove_timeslot" type="button" <?=!is_object($timeslot)?'disabled':'';?>>
                     <i class="icon-trash mr-0"></i>
                     </button>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsDays"><?=t('day');?></label>
                        <?=$form->select('timeslotsDays['.$key.']', $daysAssoc, $timeslot?$timeslot->getDay():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsStartTime"><?=t('Start time');?></label>
                        <?=$form->time('timeslotsStartTime['.$key.']', $timeslot?$timeslot->getStartTime():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsEndTime"><?=t('End time');?></label>
                        <?=$form->time('timeslotsEndTime['.$key.']', $timeslot?$timeslot->getEndTime():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="appointmentTime"><?=t('Appointment time');?></label>
                        <?=$form->number('appointmentTime['.$key.']', $timeslot?$timeslot->getAppointmentTime():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>
         </div>
         <div class="form-group text-right">
            <button class="btn btn-primary add_timeslot" type="button">
            <i class="icon-plus mr-0"></i> <?=t('Add new');?>
            </button>
         </div>
         <script id="timeslot" type="text/template">
            <div class="timeslot">
               <div class="col-auto">
                  <div class="input-group-append" style="margin-top:22px;">
                     <button class="btn btn-danger remove_timeslot" type="button">
                     <i class="icon-trash mr-0"></i>
                     </button>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsDays"><?=t('day');?></label>
                        <?=$form->select('timeslotsDays[_tmp]', $daysAssoc, $timeslot?$timeslot->getDay():'', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">   
                     <div class="form-group">
                        <label for="timeslotsStartTime"><?=t('Start time');?></label>
                        <?=$form->time('timeslotsStartTime[_tmp]', '', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="timeslotsEndTime"><?=t('End time');?></label>
                        <?=$form->time('timeslotsEndTime[_tmp]', '', ['data-required' => 'all']);?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group">
                        <label for="appointmentTime"><?=t('Appointment time');?></label>
                        <?=$form->number('appointmentTime[_tmp]', '', ['data-required' => 'all']);?>
                     </div>
                  </div>
               </div>
            </div>
         </script>
      </div>
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
<script>
   $(function() {
      $(document).on('click', '.remove_timeslot', function() {
         var holder = $('.timeslots');
         var count = $('.timeslot', holder).length;
         var current = $(this).closest('.timeslot');
         if (count > -1) {
               current.remove();
         }
         else {
               $(':input', current).val('').removeClass('is-valid').removeClass('is-invalid');
         }
      });
   
      $(document).on('click', '.add_timeslot', function() {
         var holder = $('.timeslots');
         var clone = $('#timeslot').html().replace(/_tmp/g, _tmp-1);
         $(':input:not(.btn)', clone).each(function(i, row) {
               $(row)
                  .val('')
                  .removeClass('is-valid')
                  .removeClass('is-invalid');
               if ($(row).attr('type') == 'checkbox') {
                  $(row).val(1).prop('checked', false);
               }
         });
         $(this).before(clone);
         _tmp--;
      });
   });
</script>