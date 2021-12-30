
<?php 
$total_card_xuly = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe` WHERE `status` = 'xuly' ")) ['COUNT(*)'];
$total_ruttien = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `ruttien` WHERE `status` = 'xuly' ")) ['COUNT(*)'];
$total_muathe = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `muathe` WHERE `status` = 'xuly' ")) ['COUNT(*)'];
$total_napdt = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `napdt` WHERE `status` = 'xuly' ")) ['COUNT(*)'];

?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home/" class="nav-link">HOME</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.facebook.com/ntgtanetwork" class="nav-link">LIÊN HỆ KỸ THUẬT</a>
      </li>
    </ul>
<datalist id="listuser" >
<?php $req = mysqli_query($ketnoi, "SELECT * FROM `account`");
while($row = mysqli_fetch_assoc($req)){ ?> 
<option value="<?=$row['username']?>">
<?php } ?>
</datalist>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" action="thanh-vien.php" method="post">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" list="listuser" name="timkiem" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" name="timkiem_sub" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link"  href="/dang-xuat/">
          ĐĂNG XUẤT
        </a>
        
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">QUẢN TRỊ WEBSITE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                HOME
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="thanh-vien.php" class="nav-link">
                  <p><i class="nav-icon fas fa-user-friends"></i> THÀNH VIÊN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="card-auto.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cart-plus"></i> CARD AUTO</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="card.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cart-plus"></i> QUẢN LÝ CARD <span class="badge badge-danger"><?=$total_card_xuly;?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="rut-tien.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cart-plus"></i> QUẢN LÝ RÚT TIỀN <span class="badge badge-warning"><?=$total_ruttien;?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="mua-the.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cart-plus"></i> QUẢN LÝ MUA THẺ <span class="badge badge-info"><?=$total_muathe;?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="nap-dt.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cart-plus"></i> QUẢN LÝ NẠP ĐT <span class="badge badge-danger"><?=$total_napdt;?></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="setting-card.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cogs" aria-hidden="true"></i> CÀI ĐẶT CHIẾT KHẤU</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cai-dat.php" class="nav-link">
                  <p><i class="nav-icon fa fa-cogs" aria-hidden="true"></i> CÀI ĐẶT</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
