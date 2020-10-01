<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Bendahara</th>
      <th>Keterangan</th>
      <th>Jenis Aktivitas</th>
      <th>ID</th>
      <th>Jumlah Uang</th>
      <th>Tanggal</th>
      <th><center>Aksi</th></center>
    </tr>
  </thead>

  <?php
  include 'koneksi.php';
  ini_set('date.timezone', 'Asia/Jakarta');
  $result = mysqli_query($koneksi, "SELECT * from tb_arsip order by tgl_aktivitas desc");
  $no = 1;
  while ($row = mysqli_fetch_array($result))
    { ?>
     <tr>
      <td> <?php echo $no++; ?></td>
      <td><?= $row["id_user"]?></td>                      
      <td><?= $row['aksi']?></td>
      <td><?= $row['jenis_aktivitas']?></td>
      <td><?= $row['id']?></td>
      <td><?= $row['jml']?></td>
      <td><?php $tt = $row['tgl']; echo date("d F Y", strtotime($tt))?></td>
      <td><center>

        <button type="button" class="btn btn-primary btn-xs" id="btndetail" data-id=<?php echo $row['id_arsip']?>> <i class="fa fa-info-circle" title="Detail Data"></i></button>  

        <a href="hapus_arsip.php?id=<?= $row["id_arsip"] ?>"onclick=" return confirm('Apakah anda yakin ingin menghapus data ini?');" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus Data"></i></a>
        
      </td></center>
    </tr> 
    <?php  } ?>
  </table>
  <script src="js/demo/datatables-demo.js"></script>