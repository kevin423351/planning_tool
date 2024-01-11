<?php
$persons = $persons ?? [];
?>
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
                    <td><?= h($person['personsID']) ?></td>
                    <td><?= h($person['firstname']) ?></td>
                    <td><?= h($person['lastname']) ?></td>
                    <td><?= h($person['email']) ?></td>
                    <td><?= h($person['date']) ?></td>
                </tr>
                <?php } 
            } else { ?>
                <p>No data found.</p>
            <?php } ?>
       </tbody>
    </table>
 </div>
 
