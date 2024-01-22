<?php
$appointments = $appointments ?? [];

// als er geen details of save of edit of add gezet is
?>
<?php if ($this->controller->getAction() == 'view') { ?>
   <header>
      <div class="ccm-dashboard-header-row">
         <div class="ccm-dashboard-header-title">
            <a href="#" class="ccm-dashboard-page-header-bookmark" data-page-id="266" data-token="1705653565:e5faf00324231840c3bce81d134830e7" data-bookmark-action="add-favorite">
               <span class="header-icon">
                  <svg class="icon-bookmark ">
                     <use xlink:href="#icon-bookmark-page"></use>
                  </svg>
               </span>
            </a>
            <h1>Appointments</h1>
         </div>
         <div class="ccm-dashboard-header-menu">
            <a href="<?= URL::to('/dashboard/planning_tool/appointments/add')?>" class="btn btn-success btn-sm">Add new</a>
         </div>
      </div>
   </header>
   <div class="table-responsive">
      <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
         <thead>
            <tr>
               <th class="">id</th>
               <th class="">Name</th>
               <th class="">Lastname</th>
               <th class="">Email</th>
               <th class="">Date</th>
               <th class="">Phone number</th>
               <th class="">Comment</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($appointments)) {
                  foreach ($appointments as $appointment) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?= h($appointment['appointmentID']) ?></td>
                     <td><?= h($appointment['appointmentName']) ?></td>
                     <td><?= h($appointment['appointmentLastname']) ?></td>
                     <td><?= h($appointment['appointmentEmail']) ?></td>
                     <td><?= h($appointment['appointmentDate']) ?></td>
                     <td><?= h($appointment['appointmentPhone']) ?></td>
                     <td><?= h($appointment['appointmentComment']) ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/appointments/edit',  $appointment['appointmentID']); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/appointments/delete',  $appointment['appointmentID'])?>"  class="btn btn-danger btn-sm">delete</a></td>
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
   <form method="post" action="<?=$this->action('save')?>">
      <label for="name" class="form-label">Name</label>
      <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="" required><br>

      <label for="date" class="form-label">date</label>
      <input type="text" id="appointmentDate" name="appointmentDate" class="form-control ccm-input-text" value="" required><br>

      <label for="number" class="form-label">Phone number</label>
      <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="" required><br>

      <label for="comment" class="form-label">comment</label>
      <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value="" required><br>

      <div class="ccm-dashboard-form-actions">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit persons</h2>
   <form method="post" action="<?=$this->action('saveform', $appointment->getItemID()); ?>">
      <label for="name" class="form-label">Name</label>
      <input type="text" id="appointmentName" name="appointmentName" class="form-control ccm-input-text" value="<?php echo $appointment->getFirstname(); ?>" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="appointmentLastname" name="appointmentLastname" class="form-control ccm-input-text" value="<?php echo $appointment->getLastname(); ?>" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="appointmentEmail" name="appointmentEmail" class="form-control ccm-input-text" value="<?php echo $appointment->getEmail(); ?>" required><br>

      <label for="date" class="form-label">date</label>
      <input type="text" id="appointmentDate" name="appointmentDate" class="form-control ccm-input-text" value="<?php echo $appointment->getDate(); ?>" required><br>

      <label for="number" class="form-label">Phone number</label>
      <input type="text" id="appointmentPhone" name="appointmentPhone" class="form-control ccm-input-text" value="<?php echo $appointment->getPhonenumber(); ?>" required><br>

      <label for="comment" class="form-label">comment</label>
      <input type="text" id="appointmentComment" name="appointmentComment" class="form-control ccm-input-text" value="<?php echo $appointment->getComment(); ?>" required><br>

      <div class="ccm-dashboard-form-actions">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </form>
<?php } ?>
