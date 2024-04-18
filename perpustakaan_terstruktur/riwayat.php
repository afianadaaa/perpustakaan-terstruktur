<html>
    <head>
        <style>
            table, th, td {border: 1px solid #EB66A2; border-collapse: collapse;}
            th, td {padding: 4px;}
            .items{border: 2px solid #EB66A2;width: max-content;padding: 16px;border-radius: 8px;margin-bottom: 16px;}
            .text-center{text-align:center}
            .header{position: absolute;}
            .cat{width: 120px; margin: 0px 0px -6px auto; display: flex;}
        </style>
    </head>
    <body>
        <h2>Informasi Buku yang Dipinjam</h2><hr>


<?php

include "auth.php";
$link = new mysqli("127.0.0.1", "root", "", "perpustakaan");

// Get riwayat peminjaman
$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM `peminjaman` WHERE `id_anggota` = $user_id";
$borrows = $link->query($query);

if ($borrows->num_rows > 0) {
    foreach($borrows as $b){
        $peminjaman_id = $b['id'];
        $tanggal = $b['tanggal_pinjam'];

        // Get data dari tabel dipinjam & tabel buku
        $query = "SELECT b.id, b.judul, b.penulis, d.lama_peminjaman 
        FROM buku b 
        INNER JOIN dipinjam d ON b.id = d.buku_id 
        WHERE d.peminjaman_id = $peminjaman_id";
        $books = $link->query($query);
        echo "<div class='items'>";
        echo "<div class='header'>";
        echo "<p>Nama : ".$_SESSION["user_nama"]."</p>";
        echo "<p>Tanggal : ".$tanggal."</p>";
        echo "</div>";
        //echo "<img class='cat' src='https://naufal.dev/css/cat1.png'>";
        echo "<br><br><br><br><br><table border='1'>";
        echo "<tr><th>Book ID</th><th style='width:490px'>Judul</th><th style='width:200px'>Penulis</th><th>Lama Peminjaman</th></tr>";
        while($row = $books->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='text-center'>" . $row["id"] . "</td>";
            echo "<td>" . $row["judul"] . "</td>";
            echo "<td>" . $row["penulis"] . "</td>";
            echo "<td>" . $row["lama_peminjaman"] . " Hari</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

    }


} else {
    echo "Tidak ada buku yang dipinjam.";
}


?>

</body>
</html>
