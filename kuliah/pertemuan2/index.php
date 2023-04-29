<?php

$nama = "Ilham ramadhana"

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 2</title>
    <style>
        h1 {
            color: grey;
            background-color: salmon;
            border-radius: 50px 15px 50px 15px;
            padding: 10px;
            width: 27%;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>
        <?php echo " Hello, $nama!"; ?>
    </h1>
    <p>
        <?php echo " Pemograman Web "; ?>
    </p>
    <!--  -->
    <p1>
        <?php echo " Hari Jum'at "; ?>
    </p1>
    <!--  -->
    <p2>
        <?php echo ' Kita Ujian" '; ?>
    </p2>
    <!--  -->
    <p3>
        <?php echo ' Hari Jum\'at Kita Ujian" '; ?>
    </p3>
    <!-- \ untuk digunakan ketika ada tanda petik di dalam -->
</body>

</html