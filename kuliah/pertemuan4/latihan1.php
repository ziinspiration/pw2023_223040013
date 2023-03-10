<?php
// mengecek apakah sebuah bilangan itu GANJIL / GENAP

// $angka = 5;
// jika $angka dibagi 2, sisanya 1 maka GANJIL
// kalau === dia bukan lagi perbandingan dia menjadi otoritas
function cek_ganjil_genap($angka) //ini parameter guyss
{
    if ($angka % 2 == 1) {
        return "$angka adalah bilangan GANJIL!";
    } else { // selain dari itu
        return "$angka adalah bilangan GENAP!";
    }
}

echo cek_ganjil_genap(10); // argument adalah nilai aslinya atau nilai yang ada didalam kurung ituu guyssssss
echo "<br>";
echo cek_ganjil_genap(5);
echo "<br>";
echo cek_ganjil_genap(500);
