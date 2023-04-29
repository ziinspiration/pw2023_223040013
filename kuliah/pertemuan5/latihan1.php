<?php
// ARRAY
// Array adalah variabel yang bisa menampung banyak nilai


// membuat array
$hari = array('senin', 'selasa', 'rabu', 'kamis', "jum'at", 'sabtu', 'minggu');
$bulan = ['januari', 'februari', 'maret'];
$myArray = ['aldi', 10, false];
$binatang = ['🐈', '🐇', '🐒', '🐨', '🐮'];

//mencetak array
var_dump($hari);
print_r($bulan);
var_dump($myArray);
var_dump($binatang[3]);


echo "<hr>";

//manipulasi array
//menambah elemen diakhir array
$bulan[] = 'april';
$bulan[] = 'mei';
print_r($bulan);
echo "<hr>";
array_push($bulan, 'juni', 'juli', 'agustus');
print_r($bulan);


echo "<hr>";
// Menambah elemen di awal array
array_unshift($binatang, '🐍', '🐔');
print_r($binatang);

echo "<hr>";
//menghampus elemen di akhir arrray
array_pop($hari);
print_r($hari);

echo "<hr>";

// Menghampus elemen di awal array
array_shift($hari);
print_r($hari);
