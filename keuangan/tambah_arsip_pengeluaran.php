  <?php 
  session_start();
  include"koneksi.php";

  date_default_timezone_set("ASIA/JAKARTA");
  $tanggal_aktivitas = date("Y-m-d H:i:s");

  $sql = mysqli_query($koneksi, "SELECT * FROM tb_pengeluaran WHERE id_pengeluaran IN (SELECT MAX(id_pengeluaran) FROM tb_pengeluaran)");
  $data = mysqli_fetch_array($sql);

  $id=htmlspecialchars($data["id_pengeluaran"]);  
  $tanggal=htmlspecialchars($data["tgl_keluar"]);   
  $jumlah=htmlspecialchars($data["jml_keluar"]);   
  $keterangan=htmlspecialchars($data["keterangan"]);  
  $jenis_aktivitas="Uang - Keluar";
  $aksi="Tambah Data";

  $id_user=$_SESSION['level'];



  $query =  "INSERT INTO tb_arsip
  VALUES
  ('','$id','$id_user','$tanggal_aktivitas','$jenis_aktivitas','$aksi','$keterangan','$jumlah','$tanggal')
  ";          

  mysqli_query($koneksi, $query);

  // return mysqli_affected_rows($koneksi);
     echo "<script>
    window.location='pengeluaran.php';
    </script>";

?>