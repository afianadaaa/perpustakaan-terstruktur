<?php
session_start();

function save()
{
    if (isset($_POST['lama_peminjaman']) && isset($_SESSION['peminjaman_id'])) {
        $cart = json_decode($_COOKIE['cart'], true);
        $link = new mysqli("127.0.0.1", "root", "", "perpustakaan");

        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        }

        $peminjaman_id = $_SESSION['peminjaman_id'];

        foreach ($_POST['lama_peminjaman'] as $index => $lama_peminjaman) {
            if (isset($cart[$index])) {
                $id_buku = $cart[$index][0];
                $query = "INSERT INTO dipinjam (peminjaman_id, buku_id, lama_peminjaman) VALUES ($peminjaman_id, $id_buku, $lama_peminjaman)";
                if ($link->query($query) !== TRUE) {
                    echo "Error: " . $query . "<br>" . $link->error;
                }
            }
        }

        $link->close();

        //header("Location: show-borrowed-books.php?peminjaman_id=$peminjaman_id");
        //exit();
    }
}
?>