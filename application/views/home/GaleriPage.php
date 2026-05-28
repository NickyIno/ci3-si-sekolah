<div class="container py-5">

  <!-- HEADER -->
  <div class="text-center mb-5">
    <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">
      Galeri & Dokumentasi
    </span>
    <h1 class="fw-bold text-dark display-5 mb-2">
      Dokumentasi Kegiatan Sekolah
    </h1>
    <p class="text-secondary mx-auto" style="max-width: 600px;">
      Momen-momen berharga dan dokumentasi visual dari berbagai kegiatan akademik, non-akademik, dan pentas seni di sekolah kami.
    </p>
  </div>

  <!-- GALLERY GRID -->
  <div class="row g-4">

    <?php if (!empty($galeri)): ?>
      <?php foreach ($galeri as $g): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 gallery-hover-card" 
               style="cursor: pointer;"
               data-bs-toggle="modal" 
               data-bs-target="#lightboxModal" 
               data-img-src="<?= base_url('assets/images/' . html_escape($g->gambar)) ?>"
               data-title="<?= html_escape($g->judul) ?>"
               data-date="<?= date('d F Y', strtotime($g->tanggal)) ?>">
            
            <div class="position-relative overflow-hidden" style="height: 200px;">
              <img src="<?= base_url('assets/images/' . html_escape($g->gambar)) ?>" 
                   class="w-100 h-100 object-fit-cover transition-zoom" 
                   alt="<?= html_escape($g->judul) ?>">
              <div class="position-absolute inset-0 d-flex align-items-center justify-content-center opacity-0 hover-overlay transition-fade">
                <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center shadow" style="width: 48px; height: 48px;">
                  <i class="bi bi-zoom-in fs-5"></i>
                </div>
              </div>
            </div>

            <div class="card-body p-3">
              <h6 class="fw-bold text-dark text-truncate mb-1">
                <?= html_escape($g->judul) ?>
              </h6>
              <small class="text-muted small d-block">
                <i class="bi bi-calendar-event me-1"></i>
                <?= date('d M Y', strtotime($g->tanggal)) ?>
              </small>
            </div>

          </div>

        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center py-5">
        <div class="text-muted">
          <i class="bi bi-images fs-1 d-block mb-3 opacity-50"></i>
          Belum ada dokumentasi foto yang diupload.
        </div>
      </div>
    <?php endif; ?>

  </div>

</div>


<!-- LIGHTBOX MODAL -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg bg-dark">
      
      <!-- Close button on top -->
      <div class="modal-header border-0 bg-dark text-white pb-0 d-flex justify-content-between align-items-center">
        <h6 class="modal-title fw-semibold text-truncate text-white-50" id="lightboxDate">Tanggal</h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Image display -->
      <div class="modal-body p-0 text-center bg-dark d-flex align-items-center justify-content-center" style="min-height: 300px;">
        <img id="lightboxImage" src="" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;">
      </div>

      <!-- Bottom Caption -->
      <div class="modal-footer border-0 bg-dark p-4 d-block text-center text-white">
        <h4 id="lightboxTitle" class="fw-bold mb-0">Judul Foto</h4>
      </div>

    </div>
  </div>
</div>


<!-- Script to populate lightbox modal dynamically -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const lightboxModal = document.getElementById('lightboxModal');
  if (lightboxModal) {
    lightboxModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      
      const imgSrc = button.getAttribute('data-img-src');
      const title = button.getAttribute('data-title');
      const date = button.getAttribute('data-date');
      
      const modalImg = lightboxModal.querySelector('#lightboxImage');
      const modalTitle = lightboxModal.querySelector('#lightboxTitle');
      const modalDate = lightboxModal.querySelector('#lightboxDate');
      
      modalImg.src = imgSrc;
      modalImg.alt = title;
      modalTitle.textContent = title;
      modalDate.innerHTML = `<i class="bi bi-calendar-event me-1"></i> ${date}`;
    });
  }
});
</script>

<style>
.gallery-hover-card:hover .transition-zoom {
  transform: scale(1.08);
}
.gallery-hover-card:hover .hover-overlay {
  opacity: 1 !important;
}
.transition-zoom {
  transition: transform 0.3s ease-in-out;
}
.transition-fade {
  transition: opacity 0.3s ease-in-out;
}
.inset-0 {
  top: 0; right: 0; bottom: 0; left: 0;
}
</style>
