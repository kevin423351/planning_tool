<?php if ($this->controller->getAction() == 'view') { ?>
   <div class="ccm-dashboard-header-buttons">
      <a href="<?= URL::to('/dashboard/planning_tool/expertises/add')?>" class="btn btn-success btn-sm">Add new</a>
   </div>
   <div class="table-responsive">
    <table class="ccm-results-list ccm-search-results-table ccm-search-results-table-icon">
        <thead>
            <tr>
                <th class="">Expertise Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($expertises)) {
                foreach ($expertises as $expertise) { ?>
                    <tr data-launch-search-menu="" class="">
                        <td><?php echo $expertise->getFirstname(); ?></td>
                        <td align="right">
                            <div class="btn-group" role="group">
                                <a href="<?= URL::to('/dashboard/planning_tool/expertises/edit', $expertise->getItemID()); ?>" class="btn btn-sm">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <a href="<?= URL::to('/dashboard/planning_tool/expertises/delete', $expertise->getItemID());?>" class="btn btn-sm">
                                    <i class="fas fa-trash-alt"></i> 
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="3" class="text-center">No data found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php } else if ($this->controller->getAction() == 'add') { ?>
   <h2>Add expertise</h2>
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
   <h2>Edit expertise</h2>
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

