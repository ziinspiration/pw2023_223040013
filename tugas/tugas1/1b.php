<?php
$nrp = "13";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1b</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    <!-- cara salah -->
    <p>Aku adalah angka <b><?php echo "$nrp"; ?></b></p>
    <p>Jika aku dikali 5, maka aku sekarang menjadi<b> <?php echo $nrp * 5 ?></b></p>
    <p>Jika aku dibagi 2, maka aku sekarang menjadi<b> <?php echo $nrp / 2 ?></b></p>
    <p>Jika aku ditambah 75, maka aku sekarang menjadi<b> <?php echo $nrp + 75 ?></b></p>
    <p>Jika aku dikurang 20, maka aku sekarang menjadi<b> <?php echo $nrp - 20 ?></b></p>
    <!-- cara benar 1 -->
    <br>
    <br>
    <br>
    <?php
    echo "Aku adalah angka <b>$nrp</b> <br>";
    echo "Jika aku dikali 5, maka aku sekarang menjadi <b>" . ($nrp = $nrp * 5) . "</b> <br>";
    echo "Jika aku dibagi 2, maka aku sekarang menjadi <b>" . ($nrp = $nrp / 2) . "</b> <br>";
    echo "Jika aku ditambah 75, maka aku sekarang menjadi <b>" . ($nrpa = $nrp + 75) . "</b> <br>";
    echo "Jika aku dikurang 20, maka aku sekarang menjadi <b>" . ($nrp = $nrp - 20) . "</b> <br>";
    ?>
    <!-- cara benar 2 -->
    <br>
    <br>
    <br>
    <?php
    echo "Aku adalah angka <b>$nrp</b> <br>";
    echo "Jika aku dikali 5, maka aku sekarang menjadi <b>" . ($nrp *= 5) . "</b> <br>";
    echo "Jika aku dibagi 2, maka aku sekarang menjadi <b>" . ($nrp /= 2) . "</b> <br>";
    echo "Jika aku ditambah 75, maka aku sekarang menjadi <b>" . ($nrpa += 75) . "</b> <br>";
    echo "Jika aku dikurang 20, maka aku sekarang menjadi <b>" . ($nrp -= 20) . "</b> <br>";
    ?>
</body>

</html>