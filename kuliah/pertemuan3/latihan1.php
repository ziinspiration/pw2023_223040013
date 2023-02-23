<?php
echo "Mulai. <br>";
echo "Hello World <br>";
echo "Hello World <br>";
echo "Hello World <br>";
echo "Hello World <br>";
echo "Hello World <br>";
echo "Hello World <br>";
echo "Selesai. <br>";
// Pengulangan while
// 1. Inisialisasi / Nilai awal
// 2. Kondisi Terminasi / kapan pengulangan berhenti
//  3. Increment / Decrement
// while (true) {
//     echo 'Hello World! <br>';
// }

// increment = menambah
// decrement = menurun

echo "<hr>";

// dengan false sampai 5
echo "dengan false sampai 5 (1 -4)";
$nilai_awal = 1; // inisialisasi
while ($nilai_awal < 5) { //kondisi terminasi
    echo "Hello World 1x <br>";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal += 1;
}

echo "<hr>";

echo "dengan false sama dengan 5 (1-5)";
// 
$nilai_awal = 1; // inisialisasi
while ($nilai_awal <= 5) { //kondisi terminasi
    echo "Hello World 1x <br>";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal += 1; // increment / decrement
}

echo "<hr>";

echo "dengan false sama dengan 5 (1-5)";
// 
$nilai_awal = 1; // inisialisasi
while ($nilai_awal <= 5) { //kondisi terminasi
    echo "Hello World 1x <br>";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal++; // ++ sama dengan ditambah 1
}

echo "<hr>";

// increment
echo "increment <br>";
// untuk penggulangan variabel bertambah
$nilai_awal = 1; // inisialisasi
while ($nilai_awal <= 10) { //kondisi terminasi
    echo "Hello World $nilai_awal x <br>";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal++; // ++ sama dengan ditambah 1
}

echo "<hr>";

// decrement
echo "decrement <br>";
$nilai_awal = 10; // inisialisasi
while ($nilai_awal >= 1) { //kondisi terminasi
    echo "Hello World $nilai_awal x <br>";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal--; // ++ sama dengan ditambah 1
}


echo "<hr>";

// untuk ganjil dan genap tambahkan saja 2
echo "ganjil <br>";
$nilai_awal = 1; // inisialisasi
while ($nilai_awal <= 10) { //kondisi terminasi
    echo $nilai_awal;
    echo " <br> ";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal = $nilai_awal + 2; // ++ sama dengan ditambah 1
}

echo " <hr> ";

echo "genap <br>";
$nilai_awal = 2; // inisialisasi
while ($nilai_awal <= 10) { //kondisi terminasi
    echo $nilai_awal;
    echo " <br> ";
    // $nilai_awal = $nilai_awal + 1;
    $nilai_awal = $nilai_awal + 2; // ++ sama dengan ditambah 1
}


// MENGGUNAKAN FOR
echo "<hr>";

echo "menggunakan for";
echo " <br> ";
for ($nilai_awal = 1; $nilai_awal <= 10; $nilai_awal++) {
    echo "Hello World $nilai_awal x <br>";
}

echo " <hr> ";

echo "menggunakan for";
for ($nilai_awal = 10; $nilai_awal >= 1; $nilai_awal--) {
    echo "Hello World $nilai_awal x <br>";
}
