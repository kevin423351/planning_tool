<?php
$expertises = $expertises ?? [];

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
            <h1>expertises</h1>
         </div>
         <div class="ccm-dashboard-header-menu">
            <a href="<?= URL::to('/dashboard/planning_tool/expertises/add')?>" class="btn btn-success btn-sm">Add new</a>
         </div>
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
                     <td><?= h($expertise['expertiseID']) ?></td>
                     <td><?= h($expertise['expertiseName']) ?></td>
                     <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/expertises/edit',  $expertise['expertiseID']); ?>" class="btn btn-primary btn-sm">edit</a>
                     <a href="<?= URL::to('/dashboard/planning_tool/expertises/delete',  $expertise['expertiseID'])?>"  class="btn btn-danger btn-sm">delete</a></td>
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
      <label for="name" class="form-label">Expertise Name</label>
      <input type="text" id="expertiseName" name="expertiseName" class="form-control ccm-input-text" value="" required><br>

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

