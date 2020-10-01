<?php 
session_start();

include 'koneksi.php';
date_default_timezone_set("ASIA/JAKARTA");

if(@$_SESSION['ketua'] || @$_SESSION['wakil'])  {

  $tanggal_aktivitas = date("Y-m-d H:i:s");

// tambah data
  function tambah($data)
  {
    global $koneksi;
    global $tanggal_aktivitas;
    
    $id_user=htmlspecialchars($data["id_user"]);    
    $tanggal=htmlspecialchars($data["tanggal"]);   
    $jumlah=htmlspecialchars($data["jumlah"]);
    $keterangan=htmlspecialchars($data["keterangan"]);

    

    $query =  "INSERT INTO tb_pemasukan
    VALUES
    ('','$tanggal','$jumlah','$keterangan','$id_user','$tanggal_aktivitas')
    ";          

    mysqli_query($koneksi, $query);

    // return mysqli_affected_rows($koneksi);

    echo "<script>
    window.location='tambah_arsip_pemasukan.php';
    </script>";
    
  }

  // function tambah_arsip($data)
  // {
  //   global $koneksi;
  //   global $tanggal_aktivitas;

  //   $id=htmlspecialchars($data["id_pemasukan"]);
  //   $id_user=htmlspecialchars($data["id_user"]);  
  //   $tanggal=htmlspecialchars($data["tanggal"]);   
  //   $jumlah=htmlspecialchars($data["jumlah"]);   
  //   $keterangan=htmlspecialchars($data["keterangan"]);  
  //   $jenis_aktivitas="Pemasukan";
  //   $aksi="Menambah Data";



  //   $query =  "INSERT INTO tb_arsip
  //   VALUES
  //   ('','$id','$id_user','$tanggal_aktivitas','$jenis_aktivitas','$aksi','$keterangan','$jumlah','$tanggal')
  //   ";          

  //   mysqli_query($koneksi, $query);

  //   return mysqli_affected_rows($koneksi);


  // }

  if (isset($_POST["tambah"])) {    

    if (tambah($_POST) > 0 ) {
      echo "<script>
      window.location='pemasukan.php'</script>";
    }else {
      echo mysqli_error($koneksi);
      echo "Gagal";
    }
  }
  

  ?>

  <!-- Ubah Data-->

  <?php 

  function query1($query)
  {
    global $koneksi;

    $result=mysqli_query($koneksi,$query);

    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) 
    {
      $rows[]=$row;
    }
    return $rows;
  }

  function ubah_pemasukan($data)
  {

    global $koneksi;
    global $tanggal_aktivitas;
    
    $id=htmlspecialchars($data["id"]);    
    $id_user=htmlspecialchars($data["id_user"]);    
    $tanggal=htmlspecialchars($data["tanggal"]);   
    $jumlah=htmlspecialchars($data["jumlah"]);
    $keterangan=htmlspecialchars($data["keterangan"]);

    

    $query =    "UPDATE tb_pemasukan SET
    id_user='$id_user',
    tgl_masuk='$tanggal',
    jml_masuk='$jumlah',
    keterangan='$keterangan'
    

    WHERE id_pemasukan='$id'

    ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
  }

  function tambah_arsipp($data)
  {
    global $koneksi;
    global $tanggal_aktivitas;
    
    $id=htmlspecialchars($data["id_pemasukan"]);
    $id_user=htmlspecialchars($data["id_user"]);  
    $tanggal=htmlspecialchars($data["tanggal"]);   
    $jumlah=htmlspecialchars($data["jumlah"]);   
    $keterangan=htmlspecialchars($data["keterangan"]);  
    $jenis_aktivitas="Uang - Masuk";
    $aksi="Ubah Data";


    $query =  "INSERT INTO tb_arsip
    VALUES
    ('','$id','$id_user','$tanggal_aktivitas','$jenis_aktivitas','$aksi','$keterangan','$jumlah','$tanggal')
    ";          

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);

    
  } 
  ?>
  <?php 
  if (isset($_POST["ubah"])) {

    if (ubah_pemasukan($_POST) > 0 && tambah_arsipp($_POST) > 0) {
      echo "<script>
      document.location.href = 'pemasukan.php';
      </script>";
    }else {
      echo "<script>
      alert('Tidak Ada Perubahan Data');
      document.location.href = 'pemasukan.php';
      </script>";
      echo mysqli_error($koneksi);
    }
  }
  ?>

  <?php   
  $data= mysqli_query($koneksi, "SELECT * FROM tb_pemasukan");
  $user_data = mysqli_fetch_assoc ($data);
  
  ?> 

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Keuangan - Pemasukan</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/datepicker.css" />

  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
          <div class="sidebar-brand-icon">
            <img src="img/nav.png" width="45px">
          </div>
          <div class="sidebar-brand-text mx-3">Keuangan</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-coins"></i>
            <span>Dashboard</span></a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
            Data
          </div>

          <!-- Nav Item - Tables -->
          <li class="nav-item active">
            <a class="nav-link" href="pemasukan.php">
              <i class="fas fa-fw fa-table"></i>
              <span>Pemasukan</span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="pengeluaran.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Pengeluaran</span></a>
              </li>

              <!-- Divider -->
              <hr class="sidebar-divider">

              <!-- Heading -->
              <div class="sidebar-heading">
                Arsip
              </div>

              <!-- Nav Item - Tables -->
              <li class="nav-item">
                <a class="nav-link">
                  <i class="fas fa-user-cog"></i>
                  <span>Data Arsip</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

              </ul>
              <!-- End of Sidebar -->

              <!-- Content Wrapper -->
              <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                  <!-- Topbar -->
                  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                      <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                      <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                          <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                  <i class="fas fa-search fa-sm"></i>
                                </button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </li>

                      <!-- Nav Item - User Information -->
                      <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="mr-2 d-none d-lg-inline text-gray-600 medium">
                            <!-- Keterangan Waktu -->
                            <?php
                            ini_set('date.timezone', 'Asia/Jakarta');
                            echo '' . date('l, d-m-Y');
                            ?>
                            <!-- Batas Keterangan Waktu -->
                          </span>
                          <input name="id_user" class="form-control" id="id_user" value="<?= $_SESSION['level'] ?>" readonly />
                          <img src="img/logoutt.png" width="40px">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-power-off fa-sm fa-fw text-black-400"></i>
                            Logout
                          </a>
                        </div>
                      </li>

                    </ul>

                  </nav>
                  <!-- End of Topbar -->

                  <!-- Begin Page Content -->
                  <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">

                        <h6 class="m-0 font-weight-bold text-primary">Data Pemasukan</h6>
                        <br>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_data_Modal"><i class="fas fa-plus"></i> Tambah Data</button>
                        <a class="btn btn-info hidden-print" target="blank" href="cetak_pemasukan.php" onclick=""><span class="fa fa-print"></span> Cetak Laporan</a>


                      </div>

                      <div class="card-body">
                        <div class="table-responsive">

                          <!--panggil file-->
                          <div id="datapemasukan"></div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                  <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                      <span>Copyright &copy; 2019 - ikpmpby.com</span>
                    </div>
                  </div>
                </footer>
                <!-- End of Footer -->

              </div>
              <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
              <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <!-- <a class="btn btn-primary" href="index.php">Logout</a> -->
                    <a href="logot.php" class="btn btn-primary">Logout</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- MODAL UNTUK INSERT -->
            <div id="add_data_Modal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title-bold">Tambah Pemasukan</h4>
                    <div align="right">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <div class="modal-body">
                    <form method="post" role="form">

                      <div class="form-group">
                        <label>Id Bendahara</label>
                        <input name="id_user" class="form-control" id="id_user" value="<?= $_SESSION['level'] ?>" readonly />                                
                      </div>

                      <div class="form-group">
                        <label>Tanggal Uang Masuk</label>
                        <input name="tanggal" class="form-control" id="tanggal" type="date"/>                                
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
                        <label>Jumlah Uang Masuk</label>
                        <input onkeypress="return Angkasaja(event)" name="jumlah" class="form-control" id="jumlah" onkeypress="return isNumberKey(event)" required="true"/>    
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        <input name="keterangan" class="form-control" id="keterangan" required="true"/>    
                      </div>

                      <br>
                      <div class="modal-footer">
                        <button class="btn btn-primary" name="tambah" onclick=" return confirm('Pastikan Semua Data Telah Terisi Dengan Benar');"
                        class="btn btn-danger">Simpan Data Keuangan Baru</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Logout Modal-->

            <!-- MODAL UNTUK EDIT -->
            <div id="modal_edit" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title-bold">Edit Pemasukan</h4>
                    <div align="right">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <div class="modal-body">
                    <!-- panggil isi ( scriptedit ) -->
                    <div id="data-edit"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Logout Modal-->

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/scriptedit.js"></script>
            <script src="js/demo/datatables-demo.js"></script>
            <script src="js/datepicker.js"></script>
            <script>
              $(function() {
                $('[data-toggle="datepicker"]').datepicker({
                  autoHide: true,
                  zIndex: 2048
                });
              });
            </script>

          </body>

          </html>
          <?php 
        }else {
          header("location: index.php");
        }
        ?>