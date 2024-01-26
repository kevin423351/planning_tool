<?php
$timeSlots = $timeSlots ?? [];

// als er geen details of save of edit of add gezet is
?>
<?php if ($this->controller->getAction() == 'view') { ?>
   <header>  
      <div class="ccm-dashboard-header-menu">
         <a href="<?= URL::to('/dashboard/planning_tool/timeslots/add')?>" class="btn btn-success btn-sm">Add new</a>
      </div>
   </header>
   <div class="table-responsive">
      <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
         <thead>
            <tr>
               <th class="">id</th>
               <th class="">Date</th>
               <th class="">Start date</th>
               <th class="">End time</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($timeSlots)) {
                  foreach ($timeSlots as $timeSlot) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?=$timeSlot->getItemID(); ?></td>
                     <td><?=$timeSlot->getDate(); ?></td>
                     <td><?=$timeSlot->getStartTime(); ?></td>
                     <td><?=$timeSlot->getEndTime(); ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/persons/edit',  $timeSlot->getItemID()); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/timeslots/delete',  $timeSlot->getItemID()); ?>"  class="btn btn-danger btn-sm">delete</a></td>
                  </tr>
                  <?php } 
               } else { ?>
                  <p>No data found.</p>
               <?php } ?>
         </tbody>    
      </table>
   </div>
 <?php } else if ($this->controller->getAction() == 'add') { ?>
   <h2>Add timeslots</h2>
   <form method="post" action="<?=$this->action('save')?>">
      <label for="date" class="form-label">Datum</label>
      <input type="date" id="timeSlotsDate" name="timeSlotsDate" required>

      <label for="startTime" class="form-label">Starttijd</label>
      <input type="time" id="timeSlotsStartTime" name="timeSlotsStartTime" required>

      <label for="endTime" class="form-label">Eindtijd</label>
      <input type="time" id="timeSlotsEndTime" name="timeSlotsEndTime" required>

      <div class="ccm-dashboard-form-actions">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit persons</h2>
   <form method="post" action="<?=$this->action('saveform', $expertise->getItemID()); ?>">
      <label for="name" class="form-label">Expertise Name</label>
      <input type="text" id="expertiseName" name="expertiseName" class="form-control ccm-input-text" value="<?php echo $expertise->getFirstname(); ?>" required><br>

      <div class="ccm-dashboard-form-actions">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </form>
<?php } ?>

<!-- <label for="person">Persoon:</label>
    <select id="person" name="person">
        <option value="piet">Piet</option>
        <!-- Voeg hier andere personen toe -->
    <!-- </select> -->




