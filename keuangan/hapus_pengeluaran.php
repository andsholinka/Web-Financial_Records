<?php 
session_start();

include "koneksi.php";

$id = $_GET["id"];


    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_pengeluaran WHERE id_pengeluaran = $id");


   echo "<script>
    window.location='pengeluaran.php';
    </script>"; 





 
?>