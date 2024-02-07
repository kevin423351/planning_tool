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
               <th class="">id</th>
               <th class="">Name</th>
               <th class="">lastname</th>
               <th class="">Email</th>
               <th class="">Date of birth</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($persons)) {
                  foreach ($persons as $person) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?=$person->getItemID(); ?></td>
                     <td><?=$person->getFirstname(); ?></td>
                     <td><?=$person->getLastname(); ?></td>
                     <td><?=$person->getEmail(); ?></td>
                     <td><?=$person->getDate(); ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/persons/edit',  $person->getItemID()); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/persons/delete',  $person->getItemID()); ?>"  class="btn btn-danger btn-sm">delete</a></td>
                  </tr>
                  <?php } 
               } else { ?>
                  <p>No data found.</p>
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
      <label for="expertise" class="form-label">Expertises</label><hr>
      <?php
         if (!empty($expertises)) {
            foreach ($expertises as $expertise) { ?>
               <div class="form-group">
                  <input type="checkbox" name="expertise[]" class="form-check-input" value="<?=$expertise->getItemID(); ?>">
                  <label for="expertise" class="form-label"><?=$expertise->getFirstname(); ?></label>
               </div>
            <?php }}?>
            <label for="expertise" class="form-label">time slots</label><hr>
            <div class="card">
               <div class="card-header">
                  <div class="card-title"><?=t('Address(es)');?></div>
               </div>
               <div class="card-body pt-0">
                  <div class="addresses">

                     <?php
                        $timeSlots = isset($person)?$person->getTimeSlots():[];
                        if (!count($timeSlots)) {
                           $timeSlots = ['-1' => []];
                        }
                        foreach ($timeSlots as $key => $timeSlot) {
                        ?>
                        <div class="address">
                           <div class="col-auto">
                              <div class="input-group-append" style="margin-top:22px;">
                                 <button class="btn btn-danger remove_address" type="button" <?=!count($timeSlots)?'disabled':'';?>>
                                    <i class="icon-trash mr-0"></i>
                                 </button>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group">
                                 <label for="timeslotsDays"><?=t('day');?></label>
                                 <?=$form->text('timeslotsDays['.$key.']', $timeSlot?$timeSlot->getDay():'', ['data-required' => 'all']);?>
                              </div>
                              <div class="form-group">
                                 <label for="timeSlotsStartTime"><?=t('Start time');?></label>
                                 <?=$form->time('timeSlotsStartTime['.$key.']', $timeSlot?$timeSlot->getStartTime():'', ['data-required' => 'all']);?>
                              </div>
                              <div class="form-group">
                                 <label for="timeSlotsEndTime"><?=t('End time');?></label>
                                 <?=$form->time('timeSlotsEndTime['.$key.']', $timeSlot?$timeSlot->getEndTime():'', ['data-required' => 'all']);?>
                              </div>
                              <div class="form-group">
                                 <label for="appointmentTime"><?=t('Appointment time');?></label>
                                 <?=$form->number('appointmentTime['.$key.']', $timeSlot?$timeSlot->getAppointmentTime():'', ['data-required' => 'all']);?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php } ?>

                     <div class="form-group text-right">
                        <button class="btn btn-primary add_address" type="button">
                        <i class="icon-plus mr-0"></i> <?=t('Add new');?>
                        </button>
                     </div>
                     <script id="address" type="text/template">
                        <div class="address">
                           <div class="col-auto">
                              <div class="input-group-append" style="margin-top:22px;">
                                 <button class="btn btn-danger remove_address" type="button">
                                 <i class="icon-trash mr-0"></i>
                                 </button>
                              </div>
                           </div>
                           <div class="col">
                              <div class="form-group">
                                 <label for="timeslotsDays"><?=t('day');?></label>
                                 <?=$form->text('timeslotsDays[_tmp]', '', ['data-required' => 'all']);?>
                              </div>
                              <div class="form-group">
                                 <label for="timeSlotsStartTime"><?=t('Start time');?></label>
                                 <?=$form->time('timeSlotsStartTime[_tmp]', '', ['data-required' => 'all']);?>
                              </div>
                              <div class="form-group">
                                 <label for="timeSlotsEndTime"><?=t('End time');?></label>
                                 <?=$form->time('timeSlotsEndTime[_tmp]', '', ['data-required' => 'all']);?>
                              </div>
                              <div class="form-group">
                                 <label for="appointmentTime"><?=t('Appointment time');?></label>
                                 <?=$form->number('appointmentTime[_tmp]', '', ['data-required' => 'all']);?>
                              </div>
                           </div>
                        </div>
                     </script>
                     <script>
                        $(function() {
                           $(document).on('click', '.remove_address', function() {
                              var holder = $('.addresses');
                              var count = $('.address', holder).length;
                              var current = $(this).closest('.address');
                              if (count < 1) {
                                    current.remove();
                              }
                              else {
                                    $(':input', current).val('').removeClass('is-valid').removeClass('is-invalid');
                              }
                           });

                           $(document).on('click', '.add_address', function() {
                              var holder = $('.addresses');
                              var clone = $('#address').html().replace(/_tmp/g, _tmp-1);
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
               <label for="date" class="form-label">Date of birth</label><input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value="<?=$person->getDate(); ?>" required><br>
            </div>
         </div>
      </div>
      <label for="expertise" class="form-label">Expertises</label><hr>
      <?php
         if (!empty($expertises)) {
            foreach ($expertises as $expertise) { ?>
               <div class="form-group">
                  <input type="checkbox" name="expertise[]" class="form-check-input" value="<?=$expertise->getItemID(); ?>" <?=(in_array($expertise->getItemID(), $selectedExp)) ? 'checked' : ''; ?>>
                  <label for="expertise" class="form-label"><?=$expertise->getFirstname(); ?></label>
               </div>
            <?php }}?>
            <label for="expertise" class="form-label">time slots</label><hr>
      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } ?>



