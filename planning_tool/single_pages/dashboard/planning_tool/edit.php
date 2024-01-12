<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit persons</title>
</head>
<body>

<h2>Edit persons</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id"); ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>

    <label for="lastname">lastname:</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $lastname; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

    <label for="date">date:</label>
    <input type="text" id="date" name="date" value="<?php echo $date; ?>" required><br>

    <input type="submit" value="Update">
</form>

</body>
</html>
