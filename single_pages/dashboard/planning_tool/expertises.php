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
<div class="d-flex justify-content-center mt-3">
    <ul class="pagination">
        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?= URL::to('/dashboard/planning_tool/expertises/view/' . ($currentPage - 1)) ?>">← Previous</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">← Previous</span>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
                <li class="page-item active">
                    <span class="page-link"><?= $i ?> <span class="sr-only">(current)</span></span>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?= URL::to('/dashboard/planning_tool/expertises/view/' . $i) ?>"><?= $i ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="<?= URL::to('/dashboard/planning_tool/expertises/view/' . ($currentPage + 1)) ?>">Next →</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link">Next →</span>
            </li>
        <?php endif; ?>
    </ul>
</div>

<?php } else if ($this->controller->getAction() == 'add') { ?>
   <h2>Add expertise</h2>
   <form method="post" action="<?=$this->action('saveExpertise')?>">
      <label for="name" class="form-label">Expertise Name</label>
      <input type="text" id="expertiseName" name="expertiseName" class="form-control ccm-input-text" value="" required><br>

      <div class="ccm-dashboard-form-actions-wrapper">
         <div class="ccm-dashboard-form-actions ">
            <a href="<?= URL::to('/dashboard/planning_tool/expertises/')?>" class="btn btn-secondary float-start">Cancel</a>
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

