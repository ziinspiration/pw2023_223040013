<?php
$var_first = "Topi";
$var_second = "Bundar";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1a</title>
    <style>
        h2 {
            font-style: italic;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>
    <h2>
        <?php
        echo " \"$var_first saya $var_second, $var_second $var_first saya.\" ";
        ?>
    </h2>

</body>

</html>