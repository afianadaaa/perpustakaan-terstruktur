<?php
function cari($keyword)
{
    $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan");
    $query = "SELECT * FROM buku WHERE judul LIKE '%$keyword%' OR penulis LIKE '%$keyword%'";
    $result = mysqli_query($link, $query);

    $listbuku = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = array("id" => $row['id'], "judul" => $row['judul'], "penulis" => $row['penulis']);
            $listbuku[] = $data;
        }
    }

    mysqli_close($link);

    return $listbuku;
}
function display($listbuku)
{
    echo "<br><table border=1 style='width:50%'>";
    echo "<tr><th style='width:10%'>ID</th><th style='width:60%'> Judul </th><th> Penulis</th><th></th></tr>";
    foreach ($listbuku as $row) {
        echo "<tr><td style='text-align: center;'>".$row['id']."</td><td>".$row['judul']."</td><td>".$row['penulis']."</td><td style='text-align: center;'><a href='./pinjam/pinjam.php?fitur=add&idbuku=".$row['id']."&judul=".$row['judul']."'>pinjam</a></td></tr>";
    }
    
    echo "</table>";

}
?>

<form method=get >
<input type='text' name="keyword"/>
<input type='submit' value="CARI"/>
</form>
<p> cari berdasarkan judul dan penulis</p>
<br>
<a class="link-btn" href='./pinjam/pinjam.php?fitur=read'>
    <button class="btn-pink">Lihat Keranjang</button>
</a>
<a class="link-btn" href='riwayat.php' style="margin-left: 8px">
    <button class="btn-pink">Lihat Riwayat</button>    
</a>
<br>
<style>
    button{cursor: pointer}
    .link-btn{text-decoration: none;}
    .btn-pink{color: white; background-color: #EB66A2; border: 2px solid #EB66A2; border-radius: 2px}
    .btn-pink:hover{filter: drop-shadow(0px 0px 4px #EB66A2);}
</style>