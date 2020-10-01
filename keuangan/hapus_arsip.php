<?php 
session_start();

include "koneksi.php";

$id = $_GET["id"];


    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_arsip WHERE id_arsip = $id");


	 echo "<script>
    window.location='arsip.php';
    </script>"; 





 
?>