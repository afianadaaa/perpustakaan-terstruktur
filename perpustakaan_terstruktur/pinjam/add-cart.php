<?php
function add($idbuku, $judul)
{
    //Validasi parameter $idbuku && $judul
    if(!empty($idbuku)&&!empty($judul)){
        $cookie_name = "cart";
        $cart = json_decode($_COOKIE[$cookie_name], true);
        $buku[]=$idbuku;
        $buku[]=$judul;
        $buku[]=1;          //menambahkan nilai default untuk lama_peminjaman
        $cart[]=$buku;
        setcookie($cookie_name, json_encode($cart));
    }
}
?>
