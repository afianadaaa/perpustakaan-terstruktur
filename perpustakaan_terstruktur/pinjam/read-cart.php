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
function read()
{
    $cookie_name = "cart";
    if (!isset($_COOKIE[$cookie_name])) {
        echo "cart kosong";
    } else {
        $cart = json_decode($_COOKIE[$cookie_name], true);
        echo "<pre>";
        //print_r($cart);
        echo "</pre>";
        if (!isset($_SESSION['peminjaman_id'])) {
            $link = new mysqli("127.0.0.1", "root", "", "perpustakaan");
            $user_id = $_SESSION["user_id"];
            $query = "INSERT INTO peminjaman VALUES (null, current_timestamp(),$user_id)";            
            $result = $link->query($query);
            $peminjaman_id = $link->insert_id;
            $_SESSION['peminjaman_id'] = $peminjaman_id;
            $link->close();
        } else {
            $peminjaman_id = $_SESSION['peminjaman_id'];
        }
        echo "<form action='show-borrowed-books.php' method='post'>";
        echo "<input type='hidden' name='peminjaman_id' value='$peminjaman_id'>";
        echo "<input type='hidden' name='action' value='save'>";
       
        echo "<table border=1>";
        echo "<tr><td>No</td><td>ID</td><td style='width:60%'> Judul </td><td>Lama Peminjaman</td><td>Hapus</td></tr>";
        $i=0+1;
        foreach ($cart as $index => $row) {  
            if (!empty($row[1])) {
                echo "<tr class='cart-data'>";
                echo "<td>$i</td>";
                echo "<td class='id'>{$row[0]}</td>";
                echo "<td class='judul'>{$row[1]}</td>";
                echo "<td>";
                echo "<input type='number' class='lama_peminjaman' onchange='setCookie()' value='$row[2]'> Hari"; 
                echo "</td>";
                echo "<td><a href='./pinjam.php?fitur=delete&idbuku=$index'>hapus</td>";
                echo "</tr>";
                $i++;
            }    
            // else { // ELSE tidak dibutuhkan karena fitur add sudah divalidasi di add-cart.php baris 5
            //     echo "<tr>";
            //     echo "<td>$i</td>";
            //     echo "<td>{$row[0]}</td>";
            //     echo "<td>[Unknown]</td>";
            //     echo "<td>";
            //     echo "<input type='number' name='lama_peminjaman[$index]' value='0'> Hari"; 
            //     echo "</td>";
            //     echo "<td><a href='./pinjam.php?fitur=delete&idbuku=$index'>hapus</td>";
            //     echo "</tr>";
            //     $i++;
            // }
        }
        
        echo "</table>";
        echo "<br>";
        echo "<input type='submit' name='submit' value='SIMPAN' class='btn-pink'>";
        echo "</form>";
        //echo "<a href='../fitur.php'>CARI</a> <br>";
        echo "<a class='link-btn' href='../fitur.php'>
        <button class='btn-pink'>CARI</button><br>";
        echo "<style>
        button{cursor: pointer}
        .link-btn{text-decoration: none;}
        .btn-pink{color: white; background-color: #EB66A2; border: 2px solid #EB66A2; border-radius: 2px}
        .btn-pink:hover{filter: drop-shadow(0px 0px 4px #EB66A2);}
        </style>";
        // Include file edit-cookie.php, fungsinya buat edit cookie waktu ngisi lama_peminjaman
        include "edit-cookie.php";
    }
    
}

?>