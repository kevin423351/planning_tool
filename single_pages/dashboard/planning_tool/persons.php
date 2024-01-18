<?php
$persons = $persons ?? [];

// als er geen details of save of edit of add gezet is

?>
<a href="<?= URL::to('/dashboard/planning_tool/add')?>" class="btn btn-secondary"><?=t('Add new'); ?></a>
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
                    <td align="right"><a href="<?= URL::to('/dashboard/planning_tool/edit',  $person['personID']); ?>" class="btn btn-primary btn-sm">edit</a>
                    <a href="<?= URL::to('/dashboard/planning_tool/persons/delete',  $person['personID'])?>"  class="btn btn-danger btn-sm">delete</a></td>
                </tr>
                <?php } 
            } else { ?>
                <p>No data found.</p>
            <?php } ?>
       </tbody>
       
    </table>
 </div>
 
