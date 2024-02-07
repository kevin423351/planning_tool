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
               <label for="date" class="form-label">Date of birth</label><input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value="" required><br>
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
      <?php
         if (!empty($timeSlots)) {
            foreach ($timeSlots as $timeSlot) { ?>
               <div class="form-group">
                  <input type="checkbox" name="timeslot[]" class="form-check-input" value="<?=$timeSlot->getItemID(); ?>">

                  <label for="timeslot3" class="form-label"><strong><?=$timeSlot->getDay(); ?>:<strong></label>

                  <label for="timeslot" class="form-label">available from</label>
                  <label for="timeslot" class="form-label"><?=$timeSlot->getStartTime(); ?></label>

                  <label for="timeslot" class="form-label">until</label>
                  <label for="timeslot" class="form-label"><?=$timeSlot->getEndTime(); ?></label>
                  
                  <label for="timeslot" class="form-label">appointment time</label>
                  <label for="timeslot" class="form-label"><?=$timeSlot->getAppointmentTime(); ?> minutes</label>
               </div>
            <?php }}?>
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
      <?php
         if (!empty($timeSlots)) {
            foreach ($timeSlots as $timeSlot) { ?>
               <div class="form-group">
                  <input type="checkbox" name="timeslot[]" class="form-check-input" value="<?=$timeSlot->getItemID(); ?>" <?=(in_array($timeSlot->getItemID(), $selectedtimeslot)) ? 'checked' : ''; ?>>

                  <label for="timeslot3" class="form-label"><strong><?=$timeSlot->getDay(); ?>:<strong></label>

                  <label for="timeslot" class="form-label">available from</label>
                  <label for="timeslot" class="form-label"><?=$timeSlot->getStartTime(); ?></label>

                  <label for="timeslot" class="form-label">until</label>
                  <label for="timeslot" class="form-label"><?=$timeSlot->getEndTime(); ?></label>
                  
                  <label for="timeslot" class="form-label">appointment time</label>
                  <label for="timeslot" class="form-label"><?=$timeSlot->getAppointmentTime(); ?> minutes</label>
               </div>
            <?php }}?>
      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } ?>



