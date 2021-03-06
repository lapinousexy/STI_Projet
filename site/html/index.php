<?php 
  session_start();
  if(empty($_SESSION['token'])) {
      if (function_exists('mcrypt_create_iv')) {
          $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
      } else {
          $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
      }
  }

  include_once("functions.php");
  include_once("db.php");
  include_once("model.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>STI Project</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">STI project</div>
      </a>

      <hr class="sidebar-divider my-0">

      <div class="sidebar-heading">
        Menu
      </div>

      <!-- Menu Item -->

      <?php if(isValid($_SESSION['username']) && isValid($_SESSION['password'])) {?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=write.php">
            <i class="fas fa-fw fa-pen"></i>
            <span>Send message</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=message.php">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Read message(s)</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=passwordChange.php">
            <i class="fas fa-fw fa-sync"></i>
            <span>Change password</span></a>
        </li>

        <?php if(isAdmin(getIdByUsername($_SESSION['username']))) {?>
          <li class="nav-item">
          <a class="nav-link" href="index.php?page=admin.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Admin panel</span></a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a class="nav-link" href="index.php?page=disconnect.php">
            <i class="fas fa-fw fa-times"></i>
            <span>Disconnect</span></a>
        </li>

      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?page=login.php">
            <i class="fas fa-fw fa-key"></i>
            <span>Login</span></a>
        </li>
      <?php } ?>

    </ul>
    <!-- End of Menu -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <?php // Mettre un titre dynamique ?>
                  <h6 class="m-0 font-weight-bold text-primary">
                    <?php 
                    switch($_GET['page']){
                      case 'login.php':
                        echo "Login";
                        break;
                      case 'admin.php':
                        echo "Admin";
                        break;
                      case 'message.php':
                        echo "Messages";
                        break;
                      case 'modify.php':
                        echo "Modify";
                        break;
                      case 'passwordChange.php':
                        echo "Change password";
                        break;
                      case 'write.php':
                        echo "Write message";
                        break;
                      default:
                        echo "Login";
                        break;
                    }
                    ?>
                  </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?php
                    // protection against LFI and RFI
                    $allowed = ["login.php", "admin.php", "message.php", "modify.php", "passwordChange.php", "write.php", "disconnect.php"];
                    if(in_array($_GET['page'], $allowed)){
                      include($_GET['page']);
                    }else{
                      include('login.php');
                    }
                    ?>
                </div>
              </div>
            </div>
        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>STI Project - 2019</span>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
