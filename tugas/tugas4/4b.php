<?php
$alat = ["Motherboard", "Processor", "Hard Disk", "PC Coller", "VGA Card", "SSD"];
array_push($alat, "Card Reader", "Modem");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4b</title>
</head>

<body>
    <h2>Macam-macam perangkat keras komputer</h2>
    <ol>
        <?php for ($i = 0; $i <= 5; $i++) { ?>
        <li><?= $alat[$i] ?></li>
        <?php } ?>
    </ol>
    <!-- // // // // // // // // // -->
    <h2>Macam-macam perangkat keras komputer baru</h2>
    <ol>
        <?php
        sort($alat);
        for ($i = 0; $i < count($alat); $i++) { ?>
        <li><?= $alat[$i]; ?></li>
        <?php } ?>
    </ol>
</body>

</html>