<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$sql = mysqli_query($koneksi,"select * from tb_user where username='$username' and password='$password'");
$cek = mysqli_num_rows($sql);
$data = mysqli_fetch_array($sql);
if($cek > 0){
	

	// cek jika user login sebagai ketua bendahara
	if($data['level']=="ketua"){

		$_SESSION['ketua'] = $data['id_user'];
		$_SESSION['level'] = $data['id_user'];

		header("location: keuangan/index.php");

	}else if($data['level']=="wakil"){

		$_SESSION['wakil'] = $data['id_user'];
		$_SESSION['level'] = $data['id_user'];

		header("location: keuangan/index.php");

	}else if($data['level']=="admin"){

		$_SESSION['admin'] = $data['id_user'];
		$_SESSION['level'] = $data['id_user'];

		header("location: keuangan/index_admin.php");	

	}else if($data['level']=="pemerintah"){

		$_SESSION['pemerintah'] = $data['id_user'];
		$_SESSION['level'] = $data['id_user'];

		header("location: keuangan/index_guest.php");
	}else{

		echo "<script>
		alert('Username atau Password tidak sesuai');
		window.location='index.html'</script> ";}

		
	}else{

		echo "<script>
		alert('Username atau Password tidak sesuai');
		window.location='index.html'</script> ";

	}

?>