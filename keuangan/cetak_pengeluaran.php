<?php $tgl1 = date("d-m-Y"); ?>

<?php 
include 'koneksi.php';

$query = "SELECT * FROM tb_pengeluaran";
if (isset($_POST["cari"]))
{

  $waktu=$_POST['waktu'];
  $waktu2=$_POST['waktu2'];

  if ($_POST["waktu"] > 0 && $_POST["waktu2"] > 0) {

    $query = "SELECT * FROM tb_pengeluaran WHERE tgl_keluar between '$waktu' AND '$waktu2'";
      // $query = "SELECT * FROM tb_pengeluaran WHERE tgl_keluar LIKE '%" .$waktu.$waktu2. "%'";
    
  } 

  else{

    $query = "SELECT * FROM tb_pengeluaran WHERE tgl_keluar LIKE '%" .$waktu.$waktu2. "%'";
  }

}

if (isset($_POST["reset"]))
{

  $query = "SELECT * FROM tb_pengeluaran";

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cetak Laporan Pengeluaran</title>
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.ico">


  <style type="text/css">
  @media print {
    .btn  {
      display: none;
    }
    br .a{
      display: none;
    }
  }
</style>

</head>
<body>
  <table width="80%" border="0" align="center">
    <tr>
      <td width="15%" align="center" rowspan="4"> </td>
      <td width="20%" align="right" rowspan="5"><img src="img/nav.png" width="60%"></td>
      <td width="50%" align="center" id="x" style="color:#ffff;"></td>    
      <td width="15%" align="center" rowspan="4"> </td>
    </tr>
    <tr>    

    </tr>
    <tr>
      <td align="center" colspan=""><h4></h4><p><br>
        <h6><b>IKATAN KELUARGA PELAJAR MAHASISWA<br>PROVINSI BENGKULU YOGYAKARTA</b></h6>
        <h6><b>Jl. Babaran Gg.VII No.722 A Umbulharjo, Yogyakarta.</b></h6>
      </td>
    </tr>
    <tr>
      <td><br>
      </td>
    </tr>
    <hr>
  </table>
  <br>
  <div>
    <center>
    <form method="post" class="btn">
      Cetak Dari Tanggal : <input type="date" name="waktu">
      Sampai Tanggal : <input type="date" name="waktu2">
      <button class="btn btn-primary" name="cari" type="submit">Cari</button>
      <button class="btn btn-danger" name="reset" type="submit">Reset</button>
      <button class="btn btn-info" onclick="window.print();"><span class="fa fa-print"></span> Print</button>
    </form>
      </center>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
         <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Keluar</th>
            <th>Jumlah Keluar</th>
            <th>Keterangan</th>
          </tr>
        </thead>

        <?php
        include 'koneksi.php';
        $result = mysqli_query($koneksi,$query);
        $no = 1;
        $jumlah=0;
        while ($row = mysqli_fetch_array($result))
          { ?>
           <tr align="center">
            <td> <?php echo $no++; ?></td>
            <td><?php $tt = $row['tgl_keluar']; echo date("d F Y", strtotime($tt))?></td>                      
            <td><?= $row['jml_keluar']?></td>
            <td><?= $row['keterangan']?></td>


          </tr>


          <?php $jumlah=$jumlah+$row['jml_keluar'];  } ?>
          <tr align="center">
           <td colspan="3" class="text-center"><strong>Jumlah</strong></td>
           <td colspan="1" class="text-center"><strong>Rp. <?php echo number_format($jumlah)  ?></strong></td>
         </tr>


       </table>
       <table width="70%" border="0" align="center">
        <tr>
          <td width="80%" align="right" rowspan=""></td>
          <td width="20%" align="left" id="x" > <br> Yogyakarta,
            <?php
            ini_set('date.timezone', 'Asia/Jakarta');
            echo '' . date('d-m-Y');
            ?> 
            <br><input type="text" name="" value="Bendahara" style="border: 0; background: transparent;"><br><br><br><br><br><input type="text" name="" value="Della Cairunisa H" style="border: 0; background: transparent;"> </td>

          </table>
        </body>
        </html>