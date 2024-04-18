<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        header('Location: fitur.php');
        break;
    case '/fitur.php':
        include __DIR__ . '/fitur.php';
        break;
    case '/pinjam.php':
        include __DIR__ . '/pinjam/pinjam.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
} 
/*function display($listbuku)
{
    echo "<br><table border=1 style='width:50%'>";
    echo "<tr><th style='width:10%'>ID</th><th style='width:60%'> Judul </th><th> Lama Peminjaman</th><th></th></tr>";
    foreach ($listbuku as $row) {
    echo "<tr>";
    echo "<td style='text-align: center;'>" . $row['id'] . "</td>";
    echo "<td>" . $row['judul'] . "</td>";
    echo "<td>";
    echo "<input type='number' name='lama_peminjaman[" . $row['id'] . "]' value='7'> Hari"; // Default to 7 days, you can adjust this as needed
    echo "</td>";
    echo "<td style='text-align: center;'>";
    echo "<a href='./pinjam/pinjam.php?fitur=add&idbuku=" . $row['id'] . "&judul=" . $row['judul'] . "'>pinjam</a>";
    echo "</td>";
    echo "</tr>";
}*/
?>
