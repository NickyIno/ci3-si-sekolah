<!-- HERO CAROUSEL -->
<div id="carouselSekolah"
     class="carousel slide carousel-fade"
     data-bs-ride="carousel">

  <div class="carousel-inner">

    <?php $no = 1; ?>
    <?php foreach($carousel as $c): ?>

      <div class="carousel-item <?= $no == 1 ? 'active' : '' ?>">

        <img src="<?= base_url('assets/images/' . $c->gambar) ?>"
             class="d-block w-100"
             style="height: clamp(220px, 50vw, 500px); object-fit: ;">

        <div class="carousel-caption rounded-3 p-2 p-md-4"
             style="background: rgba(0,0,0,0.5); bottom: 10px; left: 5%; right: 5%;">

          <h2 class="fw-bold fs-6 fs-md-4 fs-lg-2 mb-1">
            <?= $c->judul ?>
          </h2>

          <p class="d-none d-sm-block small mb-0">
            <?= $c->deskripsi ?>
          </p>

        </div>

      </div>

      <?php $no++; ?>
    <?php endforeach; ?>

  </div>

  <!-- BUTTON (dipindah ke DALAM div#carouselSekolah) -->
  <button class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselSekolah"
          data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next"
          type="button"
          data-bs-target="#carouselSekolah"
          data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>



<!-- PROFIL -->
<section class="container py-5">

  <div class="row align-items-center g-4">

    <div class="col-md-6 d-flex align-items-center justify-content-center"> 
        <img src="<?= base_url('assets/images/' . $profil->foto_kepala_sekolah) ?>" 
             class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover" 
             style="max-height: 450px;"> 
    </div>
    <div class="col-md-6">

      <span class="badge bg-primary mb-3">
        Profil Sekolah
      </span>

      <h2 class="fw-bold mb-3">
        <?= $profil->nama_sekolah ?>
      </h2>

      <p class="text-secondary">
        <?= $profil->profil ?>
      </p>

      <div class="mt-4">

        <h5 class="fw-bold text-primary">
          Visi
        </h5>

        <p>
          <?= $profil->visi ?>
        </p>
        
        <h5 class="fw-bold text-primary mt-3">
          Misi
        </h5>
        <p>
          <?= nl2br($profil->misi) ?>
        </p>

      </div>

    </div>

  </div>

</section>




<!-- ARTIKEL -->
<section class="bg-light py-5">

  <div class="container">

    <div class="text-center mb-5">

      <span class="badge bg-primary mb-2">
        Artikel Sekolah
      </span>

      <h2 class="fw-bold">
        Berita & Informasi Terbaru
      </h2>

    </div>

    <div class="row g-4">

<?php foreach ($artikel as $a) : ?>
    <div class="col-md-4 mb-4">
        <a href="<?= site_url('home/artikel/' . $a->slug) ?>" class="text-decoration-none text-dark">
            <div class="card border-0 shadow-sm h-100 artikel-card">
                <img src="<?= base_url('assets/images/' . $a->gambar) ?>" class="card-img-top" style="height:220px;object-fit:cover;">
                <div class="card-body">
                    <small class="text-primary fw-semibold">
                        <i class="bi bi-calendar-event me-1"></i>
                        <?= date('d M Y', strtotime($a->tanggal)) ?>
                    </small>
                    <h5 class="fw-bold mt-2">
                        <?= $a->judul ?>
                    </h5>
                    <p class="text-secondary small">
                        <?= mb_strimwidth(strip_tags($a->deskripsi), 0, 150, '...'); ?>
                    </p>
                </div>
            </div>
        </a>
    </div>
<?php endforeach; ?>


    </div>

  </div>

</section>



<!-- SARANA -->
<section class="container py-5">

  <div class="text-center mb-5">

    <span class="badge bg-primary mb-2">
      Fasilitas
    </span>

    <h2 class="fw-bold">
      Sarana & Prasarana
    </h2>

  </div>

  <div class="row g-4">

    <?php foreach($sarana as $s): ?>

    <div class="col-md-4">

      <div class="card border-0 shadow-sm h-100">

        <img src="<?= base_url('assets/images/' . $s->gambar) ?>"
             class="card-img-top"
             style="height:220px;object-fit:cover;">

        <div class="card-body">

          <h5 class="fw-bold">

            <?= $s->judul ?>

          </h5>

          <div class="mt-3">

            <span class="badge <?= $s->keadaan == 'baik' ? 'bg-success' : 'bg-danger' ?>">

              <?= 'Jumlah: ' . ucfirst($s->jumlah) ?>

            </span>

            <span class="badge <?= $s->keadaan == 'baik' ? 'bg-success' : 'bg-danger' ?>">

                            <?= 'Keadaan: ' . ucfirst($s->keadaan) ?>

            </span>

          </div>

        </div>

      </div>

    </div>

    <?php endforeach; ?>

  </div>

</section>



<!-- GALERI -->
<section class="bg-light py-5">

  <div class="container">

    <div class="text-center mb-5">

      <span class="badge bg-primary mb-2">
        Dokumentasi
      </span>

      <h2 class="fw-bold">
        Galeri Sekolah
      </h2>

    </div>

    <div class="row g-3">

      <?php foreach($galeri as $g): ?>

      <div class="col-6 col-md-3">

        <div class="card border-0 shadow-sm">

          <img src="<?= base_url('assets/images/' . $g->gambar) ?>"
               class="img-fluid rounded"
               style="height:220px;object-fit:cover;">

        </div>

      </div>

      <?php endforeach; ?>

    </div>

  </div>

</section>