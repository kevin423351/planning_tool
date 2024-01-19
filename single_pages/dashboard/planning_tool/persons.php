<?php
$persons = $persons ?? [];

// als er geen details of save of edit of add gezet is

?>
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
         <h1>Persons</h1>
      </div>
      <div class="ccm-dashboard-header-menu">
         <a href="<?= URL::to('/dashboard/planning_tool/add')?>" class="btn btn-success btn-sm">Add new</a>
      </div>
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
