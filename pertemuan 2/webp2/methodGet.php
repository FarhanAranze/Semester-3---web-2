<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Method Get</title>
</head>
<form action="" method="post">
    <label for="">Username</label> <br>
    <input type="text" name="username"> <br>
    <label for="">Password</label> <br>
    <input type="password" name="password" id=""><br>
    <button type="submit">OK</button>
    <button type="cancel">Batal</button>

</form>
<hr>
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    echo $_POST['username'] . "<br>";
    echo $_POST['password'];
}


?>

<body>

</body>

</html>