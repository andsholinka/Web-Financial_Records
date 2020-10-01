<?php 
session_start();
// $id_user = $_SESSION["id_user"];

if(@$_SESSION['ketua'] || @$_SESSION['wakil']) {

  include 'koneksi.php';

  $result = mysqli_query($koneksi,"SELECT  (SUM(jml_masuk)) as saldo FROM  tb_pemasukan");
  $pemasukan  = mysqli_fetch_array($result);

  $total_saldo = $pemasukan['saldo'];

  $result = mysqli_query($koneksi,"SELECT  (SUM(jml_keluar)) as saldo FROM  tb_pengeluaran");
  $pengeluaran  = mysqli_fetch_array($result);

  $total_saldo = $total_saldo-$pengeluaran['saldo'];


  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IKPMPBY - Keuangan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="shortcut icon" href="img/favicon.ico">

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
        <li class="nav-item active">
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
          <li class="nav-item">
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
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Keuangan IKPMPB-Y</h6>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <!--konten-->
                          <div class="row text-white">

                            <div class="card bg-success ml-3" style="width: 19rem;">
                              <div class="card-body">
                                <div class="card-body-icon">
                                  <i class="fas fa-coins mr-0.5"></i>
                                </div>
                                <h5 class="card-title">Pemasukan</h5>
                                <h5 class="total-angka">Rp. <?php echo number_format($pemasukan['saldo']);  ?></h5>
                                <a href="pemasukan.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>                    
                              </div>
                            </div>

                            <div class="card bg-info ml-3" style="width: 19rem;">
                              <div class="card-body">
                                <div class="card-body-icon">
                                  <i class="fas fa-coins mr-0.5"></i>
                                </div>
                                <h5 class="card-title">Pengeluaran</h5>
                                <h5 class="total-angka">Rp. <?php echo number_format($pengeluaran['saldo']);  ?></h5>
                                <a href="pengeluaran.php"><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>                    
                              </div>
                            </div>

                            <div class="card bg-danger ml-3" style="width: 19rem;">
                              <div class="card-body">
                                <div class="card-body-icon">
                                  <i class="fas fa-coins mr-0.5"></i>
                                </div>
                                <h5 class="card-title">Total Keuangan</h5>
                                <h5 class="total-angka">Rp. <?php echo number_format($total_saldo);  ?></h5>
                                <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>                    
                              </div>
                            </div>

                          </div>
                          <!--end off konten-->
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
                    <!-- a class="btn btn-primary" href="logout.php">Logout</a> -->
                    <a href="logot.php" class="btn btn-primary">Logout</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

          </body>

          </html>

          <?php 
        }else {
          header("location: ../index.html");
        }
        ?>