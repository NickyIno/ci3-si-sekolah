<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= $title ?></title>
  <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets\node_modules\bootstrap-icons\font\bootstrap-icons.min.css') ?>" rel="stylesheet">
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/' . $profil->logo) ?>">


  <style>

    body{
      background:#f8fbff;
    }

    .navbar{
      backdrop-filter:blur(10px);
    }

    .artikel-card{
      transition:.4s;
    }

    .artikel-card:hover{
      transform:translateY(-8px);
    }

    .section-title{
      letter-spacing:.5px;
    }


    

  </style>

</head>

<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">

  <div class="container">

    <a class="navbar-brand fw-bold text-primary d-flex align-items-center"
       href="<?= site_url('Home') ?>">

      <img src="<?= base_url('assets/images/' . $profil->logo ) ?>" alt="logo sekolah" height="48" class="me-2 rounded-circle" style="object-fit:cover;">
      <?= html_escape($profil->nama_sekolah) ?>

    </a>

    <button class="navbar-toggler"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-grid-fill" viewBox="0 0 16 16">
  <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
</svg>

    </button>

    <?php
      $current_controller = $this->uri->segment(1);
      $current_method = $this->uri->segment(2);
    ?>

    <div class="collapse navbar-collapse"
         id="navbarNav">

      <ul class="navbar-nav ms-auto gap-lg-2">

        <li class="nav-item">
          <a class="nav-link <?= ($current_controller == 'Home' || empty($current_controller)) && empty($current_method) ? 'active' : '' ?>" href="<?= site_url('Home') ?>">
            Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_controller == 'Home' && $current_method == 'profile' ? 'active' : '' ?>" href="<?= site_url('Home/profile') ?>">
            Profil
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_controller == 'Home' && ($current_method == 'artikel_list' || $current_method == 'artikel') ? 'active' : '' ?>" href="<?= site_url('Home/artikel_list') ?>">
            Artikel
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= $current_controller == 'Home' && $current_method == 'galeri' ? 'active' : '' ?>" href="<?= site_url('Home/galeri') ?>">
            Galeri
          </a>
        </li>

      </ul>

    </div>

  </div>

</nav>