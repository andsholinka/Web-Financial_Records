<?php  
session_start();

include"koneksi.php";
$id=$_GET['id'];
date_default_timezone_set("ASIA/JAKARTA");
$tanggal_aktivitas = date("Y-m-d H:i:s");
$sql = mysqli_query($koneksi, "select * from tb_pengeluaran where id_pengeluaran=$id");
$data = mysqli_fetch_array($sql);
$id = $data['id_pengeluaran'];
$jumlah = $data['jml_keluar'];
$tanggal = $data['tgl_keluar'];
$keterangan = $data['keterangan'];

           
    $jenis_aktivitas="Uang - Keluar";
    $aksi="Hapus Data";
    $id_user=$_SESSION['level'];
    

    $query =  "INSERT INTO tb_arsip
            VALUES
          ('','$id','$id_user','$tanggal_aktivitas','$jenis_aktivitas','$aksi','$keterangan','$jumlah','$tanggal')
          ";          

    mysqli_query($koneksi, $query);
   
   echo "<script>
    window.location='hapus_pengeluaran.php?id=$id';
    </script>"; 


?>