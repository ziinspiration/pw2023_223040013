<?php
function urutan_angka($numerik)
{
    $angka = 1;
    for ($a = 1; $a <= $numerik; $a++) {
        for ($b = 1; $b <= $a; $b++) {
            echo $angka . " ";
            $angka++;
        }
        echo "<br>";
    }
}

urutan_angka(5);
