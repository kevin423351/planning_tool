<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add persons</title>
</head>
<body>

<h2>Add persons</h2>

<form method="post" action="<?=$this->action('save')?>">

    <label for="name">Name:</label>
    <input type="text" id="formName" name="formName" value="" required><br>

    <label for="lastname">lastname:</label>
    <input type="text" id="formLastname" name="formLastname" value="" required><br>

    <label for="email">Email:</label>
    <input type="email" id="formEmail" name="formEmail" value="" required><br>

    <label for="date">date:</label>
    <input type="text" id="formDate" name="formDate" value="" required><br>

    <input type="submit" value="Update">
</form>

</body>
</html>
