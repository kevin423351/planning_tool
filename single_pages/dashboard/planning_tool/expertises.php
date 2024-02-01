<?php if ($this->controller->getAction() == 'view') { ?>
   <header>
      <div class="ccm-dashboard-header-menu">
         <a href="<?= URL::to('/dashboard/planning_tool/expertises/add')?>" class="btn btn-success btn-sm">Add new</a>
      </div>
   </header>
   <div class="table-responsive">
      <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
         <thead>
            <tr>
               <th class="">id</th>
               <th class="">Expertise Name</th>
            </tr>
         </thead>
         <tbody>
            <?php
               if (!empty($expertises)) {
                  foreach ($expertises as $expertise) { ?>
                  <tr data-launch-search-menu="" class="">
                     <td><?php echo $expertise->getItemID(); ?></td>
                     <td><?php echo $expertise->getFirstname(); ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/expertises/edit',  $expertise->getItemID()); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/expertises/delete',  $expertise->getItemID());?>"  class="btn btn-danger btn-sm">delete</a></td>
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
   <form method="post" action="<?=$this->action('saveExpertise')?>">
      <label for="name" class="form-label">Expertise Name</label>
      <input type="text" id="expertiseName" name="expertiseName" class="form-control ccm-input-text" value="" required><br>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } else if ($this->controller->getAction() == 'edit') { ?>
   <h2>Edit persons</h2>
   <form method="post" action="<?=$this->action('saveExpertise', $expertise->getItemID()); ?>">
      <label for="name" class="form-label">Expertise Name</label>
      <input type="text" id="expertiseName" name="expertiseName" class="form-control ccm-input-text" value="<?php echo $expertise->getFirstname(); ?>" required><br>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="#" class="btn btn-secondary float-start">Cancel</a>
            <button class="float-end btn btn-primary" type="submit">Save</button>
         </div>
      </div>
   </form>
<?php } ?>

