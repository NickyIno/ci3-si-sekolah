<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">
  <div class="container-fluid">
    <div class="panel">

      <!-- HEADER -->
      <div class="panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
          <h5 class="fw-bold mb-1">
            <i class="bi bi-bank text-primary me-2"></i>
            Profil Sekolah
          </h5>
          <small class="text-muted">Kelola informasi profil sekolah</small>
        </div>
        <button class="btn btn-primary rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#modalEditProfil">
          <i class="bi bi-pencil-square me-1"></i>
          Update Profil
        </button>
      </div>

      <!-- BODY -->
      <div class="panel-body">

        <?php if ($profil): ?>

        <!-- PROFIL DATA -->
        <div class="row g-4">

          <!-- Header Card: Logo + Nama Sekolah + Kepala Sekolah -->
          <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden"
                 style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
              <div class="card-body p-4">
                <div class="d-flex align-items-center gap-4 flex-wrap">

                  <!-- Logo -->
                  <div class="flex-shrink-0">
                    <?php if ($profil->logo): ?>
                      <img src="<?= base_url('assets/images/' . $profil->logo) ?>"
                           alt="Logo Sekolah"
                           class="rounded-3 bg-white p-1"
                           style="width: 90px; height: 90px; object-fit: contain;">
                    <?php else: ?>
                      <div class="rounded-3 bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                           style="width: 90px; height: 90px;">
                        <i class="bi bi-building text-white" style="font-size: 2.5rem;"></i>
                      </div>
                    <?php endif; ?>
                  </div>

                  <!-- Nama & Alamat -->
                  <div class="flex-grow-1">
                    <h4 class="fw-bold text-white mb-1">
                      <?= $profil->nama_sekolah ? html_escape($profil->nama_sekolah) : '<span class="opacity-75">Nama Sekolah Belum Diisi</span>' ?>
                    </h4>
                    <p class="text-white-50 mb-0">
                      <i class="bi bi-geo-alt me-1"></i>
                      <?= $profil->alamat ? html_escape($profil->alamat) : '-' ?>
                    </p>
                  </div>

                  <!-- Foto & Nama Kepala Sekolah -->
                  <div class="flex-shrink-0 text-center">
                    <?php if ($profil->foto_kepala_sekolah): ?>
                      <img src="<?= base_url('assets/images/' . $profil->foto_kepala_sekolah) ?>"
                           alt="Foto Kepala Sekolah"
                           class="rounded-circle border border-3 border-white"
                           style="width: 65px; height: 65px; object-fit: cover;">
                    <?php else: ?>
                      <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center mx-auto"
                           style="width: 65px; height: 65px;">
                        <i class="bi bi-person-fill text-white" style="font-size: 1.8rem;"></i>
                      </div>
                    <?php endif; ?>
                    <small class="text-white-50 d-block mt-1">Kepala Sekolah</small>
                    <small class="text-white fw-semibold"><?= $profil->kepala_sekolah ? html_escape($profil->kepala_sekolah) : '-' ?></small>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- Visi & Misi -->
          <div class="col-md-6">
            <div class="card border-0 bg-light rounded-4 h-100">
              <div class="card-body p-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="bi bi-eye me-2"></i>Visi
                </h6>
                <p class="text-muted mb-0">
                  <?= $profil->visi ? nl2br(html_escape($profil->visi)) : '<em>Belum diisi</em>' ?>
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-0 bg-light rounded-4 h-100">
              <div class="card-body p-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="bi bi-list-check me-2"></i>Misi
                </h6>
                <p class="text-muted mb-0">
                  <?= $profil->misi ? nl2br(html_escape($profil->misi)) : '<em>Belum diisi</em>' ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Profil Sekolah -->
          <div class="col-md-6">
            <div class="card border-0 bg-light rounded-4 h-100">
              <div class="card-body p-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="bi bi-info-circle me-2"></i>Profil Sekolah
                </h6>
                <p class="text-muted mb-0">
                  <?= $profil->profil ? nl2br(html_escape($profil->profil)) : '<em>Belum diisi</em>' ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Tentang Sekolah -->
          <div class="col-md-6">
            <div class="card border-0 bg-light rounded-4 h-100">
              <div class="card-body p-4">
                <h6 class="fw-bold text-primary mb-3">
                  <i class="bi bi-journal-text me-2"></i>Tentang Sekolah
                </h6>
                <p class="text-muted mb-0">
                  <?= $profil->tentang ? nl2br(html_escape($profil->tentang)) : '<em>Belum diisi</em>' ?>
                </p>
              </div>
            </div>
          </div>

        </div>

        <?php else: ?>

        <!-- KOSONG -->
        <div class="text-center py-5">
          <i class="bi bi-building text-muted" style="font-size: 4rem;"></i>
          <h5 class="mt-3 text-muted">Belum ada data profil</h5>
          <p class="text-muted">Klik tombol "Update Profil" untuk menambahkan informasi sekolah.</p>
        </div>

        <?php endif; ?>

      </div>
    </div>
  </div>
</div>


<!-- MODAL EDIT PROFIL -->
<div class="modal fade" id="modalEditProfil" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold text-primary">Update Profil Sekolah</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('Profile/update') ?>

        <div class="modal-body">

          <!-- Nama Sekolah -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Sekolah</label>
            <input class="form-control" name="nama_sekolah"
                   value="<?= $profil ? html_escape($profil->nama_sekolah) : '' ?>"
                   placeholder="Nama sekolah" required>
          </div>

          <!-- Kepala Sekolah -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Kepala Sekolah</label>
            <input class="form-control" name="kepala_sekolah"
                   value="<?= $profil ? html_escape($profil->kepala_sekolah) : '' ?>"
                   placeholder="Nama kepala sekolah" required>
          </div>

          <!-- Alamat -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Alamat</label>
            <input class="form-control" name="alamat"
                   value="<?= $profil ? html_escape($profil->alamat) : '' ?>"
                   placeholder="Alamat sekolah" required>
          </div>

          <!-- Visi -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Visi</label>
            <textarea class="form-control" name="visi" rows="3"
                      placeholder="Visi sekolah" required><?= $profil ? html_escape($profil->visi) : '' ?></textarea>
          </div>

          <!-- Misi -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Misi</label>
            <textarea class="form-control" name="misi" rows="4"
                      placeholder="Misi sekolah" required><?= $profil ? html_escape($profil->misi) : '' ?></textarea>
          </div>

          <!-- Profil -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Profil Sekolah</label>
            <textarea class="form-control" name="profil" rows="4"
                      placeholder="Profil singkat sekolah"><?= $profil ? html_escape($profil->profil) : '' ?></textarea>
          </div>

          <!-- Tentang -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Tentang Sekolah</label>
            <textarea class="form-control" name="tentang" rows="4"
                      placeholder="Tentang sekolah (sejarah, keunggulan, dll)"><?= $profil ? html_escape($profil->tentang) : '' ?></textarea>
          </div>

          <!-- Logo -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Logo Sekolah</label>
            <?php if ($profil && $profil->logo): ?>
              <div class="mb-2">
                <img src="<?= base_url('assets/images/' . $profil->logo) ?>"
                     alt="Logo" class="rounded border p-1"
                     style="height: 60px; object-fit: contain;">
                <small class="text-muted ms-2">Logo saat ini</small>
              </div>
            <?php endif; ?>
            <input class="form-control" type="file" name="logo"
                   accept="image/*"
                   <?= (!$profil || !$profil->logo) ? 'required' : '' ?>>
            <div class="form-text">Format: JPG, PNG, SVG. Maks 2MB.</div>
          </div>

          <!-- Foto Kepala Sekolah -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Foto Kepala Sekolah</label>
            <?php if ($profil && $profil->foto_kepala_sekolah): ?>
              <div class="mb-2">
                <img src="<?= base_url('assets/images' . $profil->foto_kepala_sekolah) ?>"
                     alt="Foto Kepsek"
                     class="rounded-circle border"
                     style="width: 60px; height: 60px; object-fit: cover;">
                <small class="text-muted ms-2">Foto saat ini</small>
              </div>
            <?php endif; ?>
            <input class="form-control" type="file" name="foto_kepala_sekolah"
                   accept="image/*">
            <div class="form-text">Format: JPG, PNG. Maks 2MB. Kosongkan jika tidak ingin mengubah.</div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Simpan Perubahan
          </button>
        </div>

      <?= form_close() ?>

    </div>
  </div>
</div>