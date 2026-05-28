<div class="container py-5">

  <!-- HEADER & FILTER -->
  <div class="row align-items-center justify-content-between g-4 mb-5">
    
    <div class="col-md-6">
      <span class="badge bg-primary px-3 py-2 rounded-pill mb-3">
        Artikel & Informasi
      </span>
      <h1 class="fw-bold text-dark display-5 mb-2">
        Kabar & Kegiatan Sekolah
      </h1>
      <p class="text-secondary mb-0">
        Ikuti perkembangan terbaru, info penting, dan serba-serbi kegiatan edukatif kami di sini.
      </p>
    </div>

    <!-- Search filter bar -->
    <div class="col-md-5 col-lg-4">
      <div class="input-group shadow-sm rounded-pill overflow-hidden">
        <span class="input-group-text border-0 bg-white ps-4">
          <i class="bi bi-search text-primary"></i>
        </span>
        <input type="text" 
               id="searchPublicArtikel" 
               class="form-control border-0 py-3 ps-2 pe-4" 
               placeholder="Cari berita atau pengumuman...">
      </div>
    </div>

  </div>

  <!-- ARTICLE GRID -->
  <div class="row g-4" id="publicArtikelContainer">

    <?php if(!empty($artikel)): ?>
      <?php foreach($artikel as $a): ?>
        <div class="col-lg-4 col-md-6 public-artikel-item">
          
          <a href="<?= site_url('home/artikel/' . html_escape($a->slug)) ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 artikel-card">
              
              <!-- Image & date badge -->
              <div class="position-relative">
                <img src="<?= base_url('assets/images/' . $a->gambar) ?>" class="card-img-top" style="height:220px;object-fit:cover;"
                     class="card-img-top object-fit-cover" 
                     style="height: 240px;" 
                     alt="<?= html_escape($a->judul) ?>">
                
                <span class="position-absolute top-0 start-0 m-3 badge bg-white bg-opacity-75 text-primary fw-bold px-3 py-2 rounded-pill shadow-sm small d-flex align-items-center gap-1">
                  <i class="bi bi-calendar3"></i>
                  <?= date('d M Y', strtotime($a->tanggal)) ?>
                </span>
              </div>

              <!-- Body details -->
              <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                  
                  <div class="d-flex align-items-center gap-3 mb-2">
                    <span class="text-primary small fw-semibold">
                      <i class="bi bi-tag-fill me-1"></i>Informasi
                    </span>
                    <span class="text-muted small">
                      <i class="bi bi-eye-fill me-1"></i><?= number_format($a->viewer) ?> Views
                    </span>
                  </div>

                  <h5 class="card-title fw-bold text-dark mb-3 lh-base">
                    <?= html_escape($a->judul) ?>
                  </h5>

                  <p class="text-secondary small mb-0 lh-lg">
                    <?= mb_strimwidth(strip_tags($a->deskripsi), 0, 160, '...'); ?>
                  </p>

                </div>

                <div class="mt-4 pt-3 border-top text-primary fw-bold d-flex align-items-center gap-2 small">
                  Baca Selengkapnya 
                  <i class="bi bi-arrow-right transition-arrow"></i>
                </div>

              </div>

            </div>
          </a>

        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center py-5">
        <div class="text-muted">
          <i class="bi bi-newspaper fs-1 d-block mb-3 opacity-50"></i>
          Belum ada artikel yang dipublikasikan.
        </div>
      </div>
    <?php endif; ?>

  </div>

</div>

<!-- Real-time Filter Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchPublicArtikel");
  if (searchInput) {
    searchInput.addEventListener("keyup", function () {
      const keyword = this.value.toLowerCase();
      const items = document.querySelectorAll(".public-artikel-item");
      
      items.forEach(item => {
        const text = item.innerText.toLowerCase();
        if (text.includes(keyword)) {
          item.style.display = "";
        } else {
          item.style.display = "none";
        }
      });
    });
  }
});
</script>

<style>
/* Subtle micro-animation for arrow transition */
.artikel-card:hover .transition-arrow {
  transform: translateX(6px);
}
.transition-arrow {
  transition: transform 0.2s ease-in-out;
}
</style>
