<?php
defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-block-type-custom-block-field"><?= $content ?></div>


<a href="#" id="getAllPersonsButton" class="btn btn-primary">Get All Persons</a>

<div class="form-group">
    <?php echo $form->label('persons', 'Choose Person(s)')?>
    <div>
        <?php echo $form->hidden('persons'); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#getAllPersonsButton').click(function(event) {
        event.preventDefault(); 
        
        $.ajax({
            url: "<?php echo $view->action('xhr');?>", // URL naar de controlleractie
            dataType: 'json',
            success: function(data) {
                console.log(data); // Log de ontvangen gegevens in de console
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
// $(document).ready(function() {
//     $('#getAllPersonsButton').click(function(event) {
//         event.preventDefault(); // Voorkom standaardgedrag van de link
        
//         $.ajax({
//             url: "", // Vervang met de juiste URL naar je controller methode
//             dataType: 'json',
//             success: function(data) {
//                 // Roep Select2-functie aan nadat de personen zijn opgehaald
//                 $('input[name=persons]').select2({
//                     placeholder: "",
//                     minimumInputLength: 1,
//                     width: '100%',
//                     multiple: true,
//                     data: data.map(function(person) {
//                         return { id: person.id, text: person.name };
//                     })
//                 });
//             },
//             error: function(xhr, status, error) {
//                 console.error(error);
//             }
//         });
//     });
// });

</script>

    

