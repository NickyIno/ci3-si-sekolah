<div class="container py-5">

    <!-- HEADER & DESKRIPSI -->
    <div class="row mb-5 pb-5 border-bottom">
        <div class="col-12">
            <h6 class="text-uppercase text-muted fw-bold mb-3 letter-spacing-1">Profil Institusi</h6>
            <h1 class="display-4 fw-bolder text-dark mb-4">
                <?= html_escape($profil->nama_sekolah) ?>
            </h1>
            
            <div class="d-flex flex-wrap gap-4 text-secondary mb-4 pb-2 border-bottom">
                <span class="d-flex align-items-center">
                    <i class="bi bi-geo-alt-fill me-2 text-dark"></i> 
                    <?= html_escape($profil->alamat) ?>
                </span>
                <span class="d-flex align-items-center">
                    <i class="bi bi-mortarboard-fill me-2 text-dark"></i> 
                    Akreditasi A
                </span>
            </div>

            <p class="lead text-dark lh-lg" style="text-align: justify;">
                <?= nl2br($profil->profil) ?>
            </p>

            <?php if (!empty($profil->tentang)): ?>
            <div class="mt-5 p-4 bg-light border-start border-4 border-secondary">
                <h5 class="fw-bold mb-3 text-uppercase fs-6">Sejarah Singkat</h5>
                <p class="mb-0 text-secondary lh-lg" style="text-align: justify;">
                    <?= html_escape($profil->tentang) ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- KEPALA SEKOLAH, VISI & MISI -->
    <div class="row g-5 mb-5 pb-5 border-bottom align-items-start">
        
        <!-- Foto Kepala Sekolah -->
        <div class="col-lg-4">
            <div class="card rounded-0 border border-secondary border-opacity-25">
                <img src="<?= base_url('assets/images/' . $profil->foto_kepala_sekolah) ?>" 
                     class="card-img-top rounded-0" 
                     style="height: 450px; object-fit: cover; object-position: top;" 
                     alt="Foto Kepala Sekolah">
                <div class="card-body p-4 text-center bg-light">
                    <h5 class="fw-bold mb-1 text-dark"><?= html_escape($profil->kepala_sekolah) ?></h5>
                    <span class="text-muted text-uppercase small fw-semibold tracking-wide">
                        Kepala Sekolah
                    </span>
                </div>
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="col-lg-8">
            <div class="mb-5">
                <h4 class="fw-bold text-uppercase border-bottom border-2 border-dark pb-3 mb-4">Visi</h4>
                <p class="fs-4 fst-italic text-dark lh-base">
                    "<?= html_escape($profil->visi) ?>"
                </p>
            </div>

            <div>
                <h4 class="fw-bold text-uppercase border-bottom border-2 border-dark pb-3 mb-4">Misi</h4>
                <ul class="list-group list-group-flush border-0">
                    <?php 
                        $misi_items = explode("\n", $profil->misi);
                        foreach ($misi_items as $item):
                            if (trim($item) !== ''):
                    ?>
                    <li class="list-group-item bg-transparent px-0 py-3 border-bottom border-secondary border-opacity-25 d-flex align-items-start">
                        <i class="bi bi-record-circle-fill text-dark me-3 mt-1" style="font-size: 0.85rem;"></i>
                        <span class="text-dark lh-lg"><?= html_escape(trim($item)) ?></span>
                    </li>
                    <?php 
                            endif;
                        endforeach; 
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- SARANA & PRASARANA -->
    <div class="row mb-4">
        <div class="col-12 text-center mb-5">
            <h6 class="text-uppercase text-muted fw-bold mb-2">Fasilitas</h6>
            <h2 class="fw-bolder text-dark text-uppercase">Sarana & Prasarana</h2>
        </div>

        <div class="row g-4">
            <?php if (!empty($sarana)): ?>
                <?php foreach ($sarana as $s): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 rounded-0 border-secondary border-opacity-25">
                            <div class="position-relative">
                                <img src="<?= base_url('assets/images/' . $s->gambar) ?>" 
                                     class="card-img-top rounded-0" 
                                     style="height: 240px; object-fit: cover;" 
                                     alt="<?= html_escape($s->judul) ?>">
                                <div class="position-absolute top-0 end-0 p-3">
                                    <?php 
                                        $kondisi = strtolower($s->keadaan);
                                        $bgClass = ($kondisi == 'baik') ? 'bg-dark' : 'bg-danger';
                                    ?>
                                    <span class="badge <?= $bgClass ?> rounded-0 text-uppercase px-3 py-2">
                                        <?= html_escape($s->keadaan) ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="fw-bold text-dark mb-4">
                                    <?= html_escape($s->judul) ?>
                                </h5>
                                
                                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                                    <span class="text-muted small text-uppercase fw-semibold">Jumlah</span>
                                    <span class="fw-bold text-dark fs-5">
                                        <?= html_escape($s->jumlah) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert bg-light rounded-0 border border-secondary border-opacity-25 text-center p-5">
                        <h5 class="text-muted text-uppercase mb-0">Belum ada data sarana prasarana</h5>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>