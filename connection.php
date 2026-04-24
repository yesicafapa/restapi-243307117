<?php
$hostname = "localhost";
$database = "db_cloudpnm";
$username = "root";
$password = ""; // KOSONGKAN BAGIAN INI (hapus tulisan di dalam petik)

$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}
?>