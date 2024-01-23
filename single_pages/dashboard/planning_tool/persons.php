<?php
$persons = $persons ?? [];

// als er geen details of save of edit of add gezet is
?>
<?php if ($this->controller->getAction() == 'view') { ?>
   <header>  
      <div class="ccm-dashboard-header-menu">
         <a href="<?= URL::to('/dashboard/planning_tool/persons/add')?>" class="btn btn-success btn-sm">Add new</a>
      </div>
   </header>
   <div class="table-responsive">
      <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
         <thead>
            <tr>
               <th class="">id</th>
               <th class="">Name</th>
               <th class="">lastname</th>
               <th class="">email</th>
               <th class="">date</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($persons)) {
                  foreach ($persons as $person) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?= h($person['personID']) ?></td>
                     <td><?= h($person['formName']) ?></td>
                     <td><?= h($person['formLastname']) ?></td>
                     <td><?= h($person['formEmail']) ?></td>
                     <td><?= h($person['formDate']) ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/persons/edit',  $person['personID']); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/persons/delete',  $person['personID'])?>"  class="btn btn-danger btn-sm">delete</a></td>
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
      <input type="text" id="formName" name="formName" class="form-control ccm-input-text" value="" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="formLastname" name="formLastname" class="form-control ccm-input-text" value="" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="formEmail" name="formEmail" class="form-control ccm-input-text" value="" required><br>

      <label for="date" class="form-label">date</label>
      <input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value="" required><br>

      <label for="expertise" class="form-label">Expertises</label><hr>
      <?php
         if (!empty($expertises)) {
            foreach ($expertises as $expertise) { ?>
               <div class="form-group">
                  <input type="checkbox" id="expertise" name="expertise" value="<?php $expertise->getItemID(); ?>" class="form-check-input">
                  <label for="expertise" class="form-label"><?php echo $expertise->getFirstname(); ?></label>
               </div>
            <?php }}?>
      <div class="ccm-dashboard-form-actions">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit persons</h2>
   <form method="post" action="<?=$this->action('saveform', $person->getItemID()); ?>">
      <label for="name" class="form-label">Name</label>
      <input type="text" id="formName" name="formName" class="form-control ccm-input-text" value="<?php echo $person->getFirstname(); ?>" required><br>

      <label for="lastname" class="form-label">lastname</label>
      <input type="text" id="formLastname" name="formLastname" class="form-control ccm-input-text" value="<?php echo $person->getLastname(); ?>" required><br>

      <label for="email" class="form-label">Email</label>
      <input type="email" id="formEmail" name="formEmail" class="form-control ccm-input-text" value="<?php echo $person->getEmail(); ?>" required><br>

      <label for="date" class="form-label">date</label>
      <input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value="<?php echo $person->getDate(); ?>" required><br>
      <label for="expertise" class="form-label">Expertises</label><hr>
      <?php
         if (!empty($expertises)) {
            foreach ($expertises as $expertise) { ?>
               <div class="form-group">
                  <input type="checkbox" id="expertise" name="expertise" value="<?php $expertise->getItemID(); ?>" class="form-check-input">
                  <label for="expertise" class="form-label"><?php echo $expertise->getFirstname(); ?></label>
               </div>
      <?php }}?>
      <div class="ccm-dashboard-form-actions">
         <a href="#" class="btn btn-secondary float-start">Cancel</a>
         <button class="float-end btn btn-primary" type="submit">Save</button>
      </div>
   </form>
<?php } ?>



