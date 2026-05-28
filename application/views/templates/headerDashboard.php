<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Sistem Sekolah</title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/images/' . $profil->logo) ?>">
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
      <link href="<?= base_url('assets\node_modules\bootstrap-icons\font\bootstrap-icons.min.css') ?>" rel="stylesheet">

  <style>
body{
  background:#f4f7fb;
  overflow-x:hidden;
  scroll-behavior: smooth;
}

.navbar {
  height: 70px;
  background: white;
  border-bottom: 1px solid #dee2e6;
}

@media (max-width: 480px) {
  .navbar .user-name,
  .navbar .dropdown-toggle .bi-chevron-down {
    display: none !important;
  }
  .navbar .dropdown-toggle {
    padding: 4px !important;
    border-radius: 50% !important;
    gap: 0 !important;
  }
}

    /* sidebar */
    .sidebar{
      position:fixed;
      top:70px;
      left:0;

      width:260px;
      height:100vh;

      background:white;
      border-right:1px solid #dee2e6;

      transition:.3s;
      z-index:1000;
    }

    /* sidebar hidden */
    .sidebar.hide{
      left:-260px;
    }

    /* content */
    .main-content{
      margin-left:260px;
      padding:20px;

      transition:.3s;
    }

    .main-content.full{
      margin-left:0;
    }

    .menu-link{
      color:#495057;
      border-radius:10px;
      padding:12px 14px;
      transition:.2s;
    }

    .menu-link:hover{
      background:#e9f2ff;
      color:#0d6efd;
    }

    .menu-link.active{
      background:#0d6efd;
      color:white;
    }

    .stat-card{
  background:white;
  border-radius:18px;
  padding:20px;
  box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.stat-icon{
  width:50px;
  height:50px;
  border-radius:14px;

  display:flex;
  align-items:center;
  justify-content:center;

  font-size:22px;
  margin-bottom:14px;
}

.stat-value{
  font-size:28px;
  font-weight:700;
}

.stat-label{
  color:#6c757d;
  font-size:14px;
}

.panel{
  background:white;
  border-radius:18px;
  box-shadow:0 2px 10px rgba(0,0,0,.05);
}

.panel-header{
  padding:20px;
  border-bottom:1px solid #eee;
}

.panel-body{
  padding:20px;
}

.table{
  margin-bottom:0;
}

.table thead th{
  font-size:14px;
  font-weight:600;
  color:#6c757d;
  border-bottom:1px solid #eee;
}

.table tbody tr{
  transition:.2s;
}

.table tbody tr:hover{
  background:#f8fbff;
}

.table td{
  vertical-align:middle;
  border-color:#f1f1f1;
}

code{
  background:#eef2ff;
  padding:4px 8px;
  border-radius:8px;
  font-size:12px;
}

.panel{
  overflow:hidden;
}
  </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar sticky-top px-3">

  <div class="container-fluid">

    <!-- kiri -->
    <div class="d-flex align-items-center gap-3">

      <!-- tombol -->
      <button class="btn btn-primary"
              id="toggleSidebar">

        <i class="bi bi-list"></i>

      </button>

      <!-- title -->
      <h5 class="fw-bold text-primary mb-0">
        Sistem Sekolah
      </h5>

    </div>

    <!-- kanan -->
    <div class="dropdown">

<button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2"
        data-bs-toggle="dropdown">


<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>

  <span class="user-name"><?= $this->session->userdata('username') ?></span>  

</button>

      <ul class="dropdown-menu dropdown-menu-end">

        <li>
          <a class="dropdown-item" href="<?= site_url('Profile') ?>">
            <i class="bi bi-person me-2"></i>Profile
          </a>
        </li>

        <li>
          <a class="dropdown-item text-danger" href="#"
             onclick="confirmLogout('<?= site_url('User/logout') ?>')">
            <i class="bi bi-box-arrow-right me-2"></i>Logout
          </a>
        </li>

      </ul>

    </div>

  </div>

</nav>


<!-- SIDEBAR -->
<div class="sidebar d-flex flex-column"
     id="sidebar">

  <!-- HEADER SIDEBAR -->
  <div class="p-3 border-bottom">

    <div class="d-flex align-items-center gap-3">

      <!-- logo -->
      <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center"
           style="width:50px;height:50px;">

        <i class="bi bi-mortarboard-fill fs-4"></i>

      </div>

      <!-- title -->
      <div>

        <h5 class="fw-bold mb-0 text-primary">
          <?= html_escape($profil->nama_sekolah) ?>
        </h5>

        <small class="text-muted">
          Sistem Sekolah
        </small>

      </div>

    </div>

  </div>

  <!-- PROFILE -->
  <div class="p-3 ">

    <div class="d-flex align-items-center gap-3">

<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>

      <div>

        <h6 class="mb-0 fw-bold">
          <?=  $this->session->userdata('username') ?>
        </h6>

        <small class="text-muted">
          <?= $this->session->userdata('role') ?>
        </small>

      </div>

    </div>

  </div>

<!-- MENU -->
  <div class="p-3 flex-grow-1">

    <small class="text-uppercase text-muted fw-bold px-2">
      Main Menu
    </small>

    <ul class="nav flex-column gap-2 mt-2">

      <!-- DASHBOARD -->
      <li class="nav-item">
        <a href="<?= site_url('Dashboard') ?>"
           class="nav-link menu-link <?= (ucfirst($this->uri->segment(1)) == 'Dashboard' || $this->uri->segment(1) == '') ? 'active' : '' ?>">
          <i class="bi bi-speedometer2 me-2"></i>
          Dashboard
        </a>
      </li>

      <!-- ARTIKEL -->
      <li class="nav-item">
        <a href="<?= site_url('Artikel') ?>"
           class="nav-link menu-link <?= ucfirst($this->uri->segment(1)) == 'Artikel' ? 'active' : '' ?>">
          <i class="bi bi-newspaper me-2"></i>
          Artikel
        </a>
      </li>

      <!-- CAROUSEL -->
      <li class="nav-item">
        <a href="<?= site_url('Carousel') ?>"
           class="nav-link menu-link <?= ucfirst($this->uri->segment(1)) == 'Carousel' ? 'active' : '' ?>">
          <i class="bi bi-images me-2"></i>
          Carousel
        </a>
      </li>

      <!-- GALERI -->
      <li class="nav-item">
        <a href="<?= site_url('Galeri') ?>"
           class="nav-link menu-link <?= ucfirst($this->uri->segment(1)) == 'Galeri' ? 'active' : '' ?>">
           <i class="bi bi-images me-2"></i>
          Galeri
        </a>
      </li>

      <!-- SARANA & PRASARANA -->
      <li class="nav-item">
        <a href="<?= site_url('Sarana') ?>"
           class="nav-link menu-link <?= ucfirst($this->uri->segment(1)) == 'Sarana' ? 'active' : '' ?>">
          <i class="bi bi-building me-2"></i>
          Sarana & Prasarana
        </a>
      </li>
      
      <!-- PROFIL SEKOLAH -->
      <li class="nav-item">
        <a href="<?= site_url('Profile') ?>"
           class="nav-link menu-link <?= ucfirst($this->uri->segment(1)) == 'Profile' ? 'active' : '' ?>">
          <i class="bi bi-bank me-2"></i>
          Profil Sekolah
        </a>
      </li>

      <!-- KELOLA USER -->
      <li class="nav-item">
        <a href="<?= site_url('KelolaUser') ?>"
           class="nav-link menu-link <?= ucfirst($this->uri->segment(1)) == 'KelolaUser' ? 'active' : '' ?>">
          <i class="bi bi-people-fill me-2"></i>
          Kelola User
        </a>
      </li>

    </ul>

  </div>
</div>