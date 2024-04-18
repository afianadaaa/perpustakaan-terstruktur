<html>
    <body>
<?php
include "auth.php";
echo "<h2>Selamat datang ".$_SESSION["user_nama"]."</h2>";
include "cari.php";
$fitur = $_GET['fitur'] ?? null;
switch ($fitur) {
    case 'pinjam':
        header('location:pinjam/pinjam.php?fitur=read');
        exit;
    case 'cari':
    default:
        $keyword = $_GET['keyword'] ?? null;
        $listbuku = cari($keyword);
        display($listbuku);
        break;
}
?>

<br>
<a class="link-btn" href="logout.php">
    <button class="btn-red">Logout</button>
</a>
    </body>
    <style>
    button{cursor: pointer}
    .link-btn{text-decoration: none;}
    .btn-red{color: white; background-color: #E72929; border: 2px solid #E72929; border-radius: 2px}
    .btn-red:hover{filter: drop-shadow(0px 0px 4px #E72929);}
</style>
</html>