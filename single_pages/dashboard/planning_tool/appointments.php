<?php if ($this->controller->getAction() == 'view') { ?>
   <div class="ccm-dashboard-header-buttons">
      <a href="<?= URL::to('/dashboard/planning_tool/appointments/add')?>" class="btn btn-success btn-sm">Add new</a>
   </div>
   <div class="table-responsive ">
      <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
         <thead>
            <tr>
               <th class="">id</th>
               <th class="">Name</th>
               <th class="">Lastname</th>
               <th class="">Email</th>
               <th class="">Date of birth</th>
               <th class="">Phone number</th>
               <th class="">Comment</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($appointments)) {
                  foreach ($appointments as $appointment) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?php echo $appointment->getItemID(); ?></td>
                     <td><?php echo $appointment->getFirstname(); ?></td>
                     <td><?php echo $appointment->getLastname(); ?></td>
                     <td><?php echo $appointment->getEmail(); ?></td>
                     <td><?php echo $appointment->getDate(); ?></td>
                     <td><?php echo $appointment->getPhonenumber(); ?></td>
                     <td><?php echo $appointment->getComment(); ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/appointments/edit', $appointment->getItemID()); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/appointments/delete',  $appointment->getItemID()); ?>"  class="btn btn-danger btn-sm">delete</a></td>
                  </tr>
                  <?php } 
               } else { ?>
                  <p>No data found.</p>
               <?php } ?>
         </tbody>    
      </table>
   </div>
<?php } else if ($this->controller->getAction() == 'add') { ?>
   <h2>Add persons</h2>
   <form method="post" action="<?=$this->action('saveAppointment')?>">
      <label for="name" class="form-label">Name</label>
      <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="" required><br>

      <label for="date" class="form-label">Date of birth</label>
      <input type="text" id="appointmentDate" name="appointmentDate" class="form-control ccm-input-text" value=""><br>

      <label for="number" class="form-label">Phone number</label>
      <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="" required><br>

      <label for="comment" class="form-label">comment</label>
      <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value=""><br>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit persons</h2>
   <form method="post" action="<?=$this->action('saveAppointment', $appointment->getItemID()); ?>">
      <label for="name" class="form-label">Name</label>
      <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="<?php echo $appointment->getFirstname(); ?>" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="<?php echo $appointment->getLastname(); ?>" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="<?php echo $appointment->getEmail(); ?>" required><br>

      <label for="date" class="form-label">Date of birth</label>
      <input type="text" id="appointmentDate" name="appointmentDate" class="form-control ccm-input-text" value="<?php echo $appointment->getDate(); ?>"><br>

      <label for="number" class="form-label">Phone number</label>
      <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="<?php echo $appointment->getPhonenumber(); ?>" required><br>

      <label for="comment" class="form-label">comment</label>
      <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value="<?php echo $appointment->getComment(); ?>"><br>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } ?>

