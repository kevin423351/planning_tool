<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-block-wrapper">
    <div class="ccm-block-type-custom-block-field"><?= $content ?></div>

<?php   if ($choice == '') { ?>
    <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="set-choice" data-value="person" class="btn btn-primary">Persoon</a>
    &nbsp;&nbsp;&nbsp;
    <a href="<?php echo $view->action('choice', Core::make('token')->generate('choice'))?>" data-action="set-choice" data-value="expertise" class="btn btn-primary">Expertise</a>
<?php   } else { 
            if ($choice == 'person') { ?>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="personID" class="form-label">With who?</label>
                            <select id="personID" name="personID" class="form-select">
                                <?php foreach ($persons as $person){ ?>
                                    <option value="<?= $person->getItemID(); ?>"><?= $person->getFirstname(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
<?php       } elseif ($choice == 'expertise') { ?>
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="expertiseID" class="form-label">With who?</label>
                            <select id="expertiseID" name="expertiseID" class="form-select">
                                <?php foreach ($expertises as $expertise){ ?>
                                    <option value="<?= $expertise->getItemID(); ?>"><?= $expertise->getFirstname(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
<?php       }
        } ?>
</div>


<script>
$(function() {
    $('a[data-action=set-choice]').on('click', function() {
        $.ajax({
            type: 'POST',
		    cache: false,
            data: { choice: $(this).data('value') },
            url: $(this).attr('href'),
            dataType: 'html',
            success: function(response) {
                $('div.ccm-block-wrapper').replaceWith(response);
            }
        });
        return false;
    });
});
</script>

    

