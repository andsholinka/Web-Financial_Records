  <?php 
  session_start();
  include"koneksi.php";

  date_default_timezone_set("ASIA/JAKARTA");
  $tanggal_aktivitas = date("Y-m-d H:i:s");

  $sql = mysqli_query($koneksi, "SELECT * FROM tb_pemasukan WHERE id_pemasukan IN (SELECT MAX(id_pemasukan) FROM tb_pemasukan)");
  $data = mysqli_fetch_array($sql);

  $id=htmlspecialchars($data["id_pemasukan"]);  
  $tanggal=htmlspecialchars($data["tgl_masuk"]);   
  $jumlah=htmlspecialchars($data["jml_masuk"]);   
  $keterangan=htmlspecialchars($data["keterangan"]);  
  $jenis_aktivitas="Uang - Masuk";
  $aksi="Tambah Data";

  $id_user=$_SESSION['level'];



  $query =  "INSERT INTO tb_arsip
  VALUES
  ('','$id','$id_user','$tanggal_aktivitas','$jenis_aktivitas','$aksi','$keterangan','$jumlah','$tanggal')
  ";          

  mysqli_query($koneksi, $query);

  // return mysqli_affected_rows($koneksi);
     echo "<script>
    window.location='pemasukan.php';
    </script>";

?>