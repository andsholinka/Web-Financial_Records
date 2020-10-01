 <?php
 session_start();
 include"koneksi.php";
 $view = mysqli_query($koneksi, "select * from tb_arsip where id_arsip= $_POST[id_arsip]");
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
  <label>Tanggal Aktivitas</label>
  <input name="id_user" class="form-control" value="<?php $ttt = $user_data['tgl_aktivitas']; echo date("d F Y H:i:s", strtotime($ttt))?>" type="datetime" readonly />
</div>

<div class="form-group">
  <label>Id Bendahara</label>
  <input name="id_user" class="form-control"  value="<?php echo $user_data['id_user'] ; ?>" readonly />                                
</div>

<div class="form-group">
  <label>Aksi</label>
  <input name="aksi" class="form-control"  value="<?php echo $user_data['aksi'] ; ?>" readonly >    
</div>

<div class="form-group">
  <label>Jenis Aktivitas</label>
  <input name="tanggal" class="form-control"  value="<?php echo $user_data['jenis_aktivitas'] ; ?>" readonly />                                
</div>

<div class="form-group">
  <label>Jumlah</label>
  <input name="jumlah" class="form-control"  value="<?php echo $user_data['jml'] ; ?>" onkeypress="return isNumberKey(event)" readonly />    
</div>

<div class="form-group">
  <label>Keterangan</label>
  <input name="keterangan" class="form-control" value="<?php echo $user_data['keterangan'] ; ?>" readonly >    
</div>

<div class="form-group">
  <label>Tanggal</label>
  <input name="tanggal" class="form-control"  value="<?php $tt = $user_data['tgl']; echo date("d F Y", strtotime($tt))?>" readonly />                                
</div>

</form>