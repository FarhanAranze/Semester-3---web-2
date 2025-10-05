<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $total = 0;
    $buah = 20000;
    $ayam = 30000;
    $sayur = 10000;

    $total += $buah;
    $total += $ayam;
    $total += $sayur;

    var_dump($total);
    ?>
</body>
</html>