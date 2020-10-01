<?php 
session_start();

include "koneksi.php";

$id = $_GET["id"];


    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_pemasukan WHERE id_pemasukan = $id");


	 echo "<script>
    window.location='pemasukan.php';
    </script>"; 





 
?>