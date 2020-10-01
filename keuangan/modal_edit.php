 <?php
 session_start();
 include"koneksi.php";
 $view = mysqli_query($koneksi, "select * from tb_pemasukan where id_pemasukan= $_POST[id]");
 if (!$view) {
  printf("Error: %s\n", mysqli_error($koneksi));
  exit();
}
$user_data = mysqli_fetch_array($view);

?>

<form method="post" role="form">
 <div class="form-group">
  <input type="hidden" name="id" value="<?php echo $user_data['id_pemasukan'] ; ?>">
  <p style="color:red" id="error_edit_id"></p>
</div>

<div class="form-group">
  <input type="hidden" name="id_pemasukan" class="form-control" id="id_pemasukan" value="<?php echo $user_data['id_pemasukan'] ; ?>" readonly />               
</div>

<div class="form-group">
  <label>Id Bendahara</label>
  <input name="id_user" class="form-control" id="id_user" value="<?= $_SESSION['level'] ?>" readonly />                                
</div>

<div class="form-group">
  <label>Tanggal Masuk</label>
  <input name="tanggal" class="form-control" id="tanggal" value="<?php echo $user_data['tgl_masuk'] ; ?>" type="date"/>                                
</div>

<div class="form-group">
  <script type="text/javascript">
    function Angkasaja(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }
  </script>
  <label>Jumlah Masuk</label>
  <input onkeypress="return Angkasaja(event)" name="jumlah" class="form-control" id="jumlah" value="<?php echo $user_data['jml_masuk'] ; ?>" onkeypress="return isNumberKey(event)" required="true"/>    
</div>

<div class="form-group">
  <label>Keterangan</label>
  <input name="keterangan" class="form-control" id="keterangan" value="<?php echo $user_data['keterangan'] ; ?>" required="true"/>    
</div>

<br>
<div class="modal-footer">
  <button class="btn btn-primary" name="ubah" onclick=" return confirm('Pastikan Semua Data Telah Terisi Dengan Benar');"
  class="btn btn-danger">Simpan Data Keuangan Baru</button>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
</div>
</form>