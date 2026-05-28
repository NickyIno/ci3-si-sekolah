<div class="container py-5">

    <!-- Artikel Card -->
    <div class="card border-0 shadow-lg overflow-hidden">

        <!-- Gambar -->
        <img 
            src="<?= base_url('assets/images/' . $artikel->gambar  )?>" 
            class="img-fluid w-100"
            style="max-height: 500px; object-fit: contain;"
            alt="<?= $artikel->judul ?>"
        >

        <!-- Content -->
        <div class="card-body p-4 p-md-5">

            <!-- Badge -->
            <div class="d-flex flex-wrap gap-2 mb-3">

                <span class="badge bg-primary px-3 py-2 rounded-pill">
                    Artikel
                </span>

                <span class="badge bg-dark-subtle text-dark px-3 py-2 rounded-pill">
                    👁 <?= number_format($artikel->viewer) ?> Viewer
                </span>

            </div>

            <!-- Judul -->
            <h1 class="fw-bold display-6 mb-3">
                <?= $artikel->judul; ?>
            </h1>

            <!-- Info -->
            <div class="d-flex flex-wrap align-items-center text-secondary mb-4 small gap-3">

                <div>
                     <?= date('d F Y H:i', strtotime($artikel->tanggal)); ?>
                </div>

                <div>
                     Artikel #<?= $artikel->id ?>
                </div>

            </div>

            <hr>

            <!-- Deskripsi -->
            <div class="fs-5 lh-lg text-dark">

                <?= nl2br($artikel ->deskripsi); ?>

            </div>

        </div>

    </div>

    <!-- Tombol Back -->
    <div class="mt-4">

        <a href="<?= base_url(); ?>" 
           class="btn btn-outline-primary btn-lg rounded-pill px-4">

            ← Kembali

        </a>

    </div>

</div>