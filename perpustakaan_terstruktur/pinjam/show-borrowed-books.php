<html>
    <head>
        <style>
            table, th, td {border: 1px solid #EB66A2; border-collapse: collapse;}
            th, td {padding: 4px;}
            .items{border: 2px solid #EB66A2;width: max-content;padding: 16px;border-radius: 8px;margin-bottom: 16px;}
            .text-center{text-align:center}
            .header{position: absolute;}
        </style>
    </head>
    <body>
<?php

include "../auth.php";

$link = new mysqli("127.0.0.1", "root", "", "perpustakaan");
if(isset($_POST['peminjaman_id'])) {
    $peminjaman_id = $_POST['peminjaman_id'];

    // Masukkan data cart ke tabel dipinjam
    $carts = json_decode($_COOKIE['cart'], true); 
    foreach($carts as $c){
        $query = "INSERT INTO `dipinjam` VALUES (null, $peminjaman_id, $c[0], $c[2])";
        $link->query($query);
    }
    unset($_COOKIE['cart']);
    
    // Get tanggal
    $query = "SELECT * FROM `peminjaman` WHERE `id` = $peminjaman_id";
    $result = $link->query($query)->fetch_assoc();
    $tanggal = $result['tanggal_pinjam'];

    // Get data dari tabel dipinjam & tabel buku
    $query = "SELECT b.id, b.judul, b.penulis, d.lama_peminjaman 
              FROM buku b 
              INNER JOIN dipinjam d ON b.id = d.buku_id 
              WHERE d.peminjaman_id = $peminjaman_id";
    $result = $link->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Informasi Buku yang Dipinjam</h2>";
        echo "<p>Nama : ".$_SESSION["user_nama"]."</p>";
        echo "<p>Tanggal : ".$tanggal."</p>";
        echo "<table border='1'>";
        echo "<tr><th>Book ID</th><th style='width:60%'>Judul</th><th>Penulis</th><th>Lama Peminjaman</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["judul"] . "</td>";
            echo "<td>" . $row["penulis"] . "</td>";
            echo "<td>" . $row["lama_peminjaman"] . " Hari</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada buku yang dipinjam.";
    }
} else {
    echo "Parameter peminjaman_id tidak ditemukan.";
}
?>
