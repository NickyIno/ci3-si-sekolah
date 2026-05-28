<footer style="background: #0d6efd; color: #fff; padding: 2.5rem 2rem 1.5rem;">

  <div class="container">
    <div class="row g-4 pb-4" style="border-bottom: 0.5px solid rgba(255,255,255,0.15);">

      <!-- Brand -->
      <div class="col-12 col-md-5">
        <div class="d-flex align-items-center gap-2 mb-2">
          <div class="d-flex align-items-center justify-content-center rounded-2" 
               style="width:38px;height:38px;background:rgba(255,255,255,0.15);">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 16 16">
              <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
              <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
            </svg>
          </div>
          <span class="fw-bold fs-6"><?= html_escape($profil->nama_sekolah) ?></span>
        </div>
        <p style="font-size:13px;color:rgba(255,255,255,0.6);line-height:1.6;">
          Sistem Informasi Sekolah yang menyediakan layanan informasi akademik dan administrasi secara terpadu.
        </p>
        <span style="display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,0.1);
                     border:0.5px solid rgba(255,255,255,0.2);border-radius:20px;
                     padding:4px 10px;font-size:11px;color:rgba(255,255,255,0.8);">
          ✓ Terakreditasi A
        </span>
      </div>

      <!-- Navigasi -->
      <div class="col-6 col-md-3">
        <p style="font-size:11px;font-weight:500;letter-spacing:.08em;text-transform:uppercase;
                  color:rgba(255,255,255,0.45);margin-bottom:14px;">Navigasi</p>
        <div class="d-flex flex-column gap-2">
          <a href="#" class="footer-link" style="font-size:13px;color:rgba(255,255,255,0.7);text-decoration:none;">Beranda</a>
          <a href="#" class="footer-link" style="font-size:13px;color:rgba(255,255,255,0.7);text-decoration:none;">Artikel &amp; Berita</a>
          <a href="#" class="footer-link" style="font-size:13px;color:rgba(255,255,255,0.7);text-decoration:none;">Tentang Kami</a>
          <a href="#" class="footer-link" style="font-size:13px;color:rgba(255,255,255,0.7);text-decoration:none;">Kontak</a>
        </div>
      </div>

      <!-- Kontak -->
      <div class="col-6 col-md-4">
        <p style="font-size:11px;font-weight:500;letter-spacing:.08em;text-transform:uppercase;
                  color:rgba(255,255,255,0.45);margin-bottom:14px;">Kontak</p>
        <p style="font-size:13px;color:rgba(255,255,255,0.7);margin-bottom:8px;">
          📍 <?= html_escape($profil->alamat) ?>
        </p>
        <p style="font-size:13px;color:rgba(255,255,255,0.7);margin-bottom:8px;">
          📞 (0274) 000-0000
        </p>
        <p style="font-size:13px;color:rgba(255,255,255,0.7);">
          ✉ info@sekolah.sch.id
        </p>
      </div>

    </div>

    <!-- Bottom bar -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-3">
      <span style="font-size:12px;color:rgba(255,255,255,0.45);">
        © <?= date('Y') ?> <?= html_escape($profil->nama_sekolah) ?>. Hak cipta dilindungi.
      </span>
      <div class="d-flex gap-2">
        <a href="#" style="width:30px;height:30px;border-radius:8px;border:0.5px solid rgba(255,255,255,0.2);
                           background:rgba(255,255,255,0.08);display:flex;align-items:center;
                           justify-content:center;color:rgba(255,255,255,0.7);text-decoration:none;font-size:14px;">f</a>
        <a href="#" style="...">ig</a>
        <a href="#" style="...">yt</a>
      </div>
    </div>

  </div>

</footer>

<!-- ---  Flashdata untuk SweetAlert --- -->
<?php if($this->session->flashdata('success')): ?>
<div id="flash-success" data-message="<?= htmlspecialchars($this->session->flashdata('success')) ?>" style="display:none;"></div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<div id="flash-error" data-message="<?= htmlspecialchars($this->session->flashdata('error')) ?>" style="display:none;"></div>
<?php endif; ?>

<?php if($this->session->flashdata('warning')): ?>
<div id="flash-warning" data-message="<?= htmlspecialchars($this->session->flashdata('warning')) ?>" style="display:none;"></div>
<?php endif; ?>

<script src="<?= base_url('assets/js/sweetalert.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script>
  // Hover efek artikel cards
  document.querySelectorAll('.artikel-card').forEach(card => {
    card.addEventListener('mouseenter', () => card.classList.add('shadow-lg'));
    card.addEventListener('mouseleave', () => card.classList.remove('shadow-lg'));
  });

  // Hover efek footer links
  document.querySelectorAll('.footer-link').forEach(link => {
    link.addEventListener('mouseenter', () => link.classList.replace('text-white-50', 'text-white'));
    link.addEventListener('mouseleave', () => link.classList.replace('text-white', 'text-white-50'));
  });
</script>

</body>
</html>