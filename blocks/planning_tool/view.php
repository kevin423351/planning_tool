<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

    <div class="ccm-block-type-custom-block-field"><?= $content ?></div>
    <button type="button" class="btn btn-dark">Afspraak maken</button>

    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/personview')?>" class="btn btn-primary btn-sm">personen</a>
    <a href="<?= URL::to('/dashboard/planning_tool/setappointments/expertiseview')?>" class="btn btn-primary btn-sm">expertises</a>

