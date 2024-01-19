<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit persons</title>
</head>
<body>

<h2>Edit persons</h2>

<form method="post" action="<?=$this->action('save', $person->getItemID()); ?>">
    <label for="name" class="form-label">Name</label>
    <input type="text" id="formName" name="formName" class="form-control ccm-input-text" value="<?php echo $person->getFirstname(); ?>" required><br>

    <label for="lastname" class="form-label">lastname</label>
    <input type="text" id="formLastname" name="formLastname" class="form-control ccm-input-text" value="<?php echo$person->getLastname(); ?>" required><br>

    <label for="email" class="form-label">Email</label>
    <input type="email" id="formEmail" name="formEmail" class="form-control ccm-input-text" value="<?php echo $person->getEmail(); ?>" required><br>

    <label for="date" class="form-label">date</label>
    <input type="text" id="formDate" name="formDate" class="form-control ccm-input-text" value="<?php echo $person->getDate(); ?>" required><br>

    <div class="ccm-dashboard-form-actions">
        <a href="#" class="btn btn-secondary float-start">Cancel</a>
        <button class="float-end btn btn-primary" type="submit">Save</button>
    </div>
</form>

</body>
</html>
