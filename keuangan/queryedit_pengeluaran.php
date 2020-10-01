<?php

include"koneksi.php";
$id = $_POST['id'];
$id_user = $_POST['id_user'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];


if ($noMutasi == '') {
	$data['error']['edit_id'] = 'Pastikan Semua Data Terisi';
}

if (empty($data['error'])) {
	$query = "UPDATE tb_pengeluaran SET
	id_user='$id_user',
	tgl_keluar='$tanggal',
	jml_keluar='$jumlah',
	keterangan='$keterangan'


	WHERE id_pengeluaran='$id'

	";

	mysqli_query($mysqli, $query)
	or die("Gagal Perintah SQL".mysql_error());
	$data['hasil'] = 'sukses';
} else {
	$data['hasil'] = 'gagal';
}
echo json_encode($data);
