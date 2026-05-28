<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">
  <div class="container-fluid">

    <!-- PANEL -->
    <div class="panel">

      <!-- HEADER -->
      <div class="panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div>
          <h4 class="fw-bold mb-1">
            <i class="bi bi-images text-primary me-2"></i>
            Galeri Foto
          </h4>
          <small class="text-muted">Kelola foto kegiatan sekolah</small>
        </div>

        <button class="btn btn-primary rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">
          <i class="bi bi-plus-lg me-1"></i>
          Tambah Foto
        </button>

      </div>

      <!-- BODY -->
      <div class="panel-body">

        <!-- SEARCH -->
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" id="searchGaleri" class="form-control" placeholder="Cari galeri...">
            </div>
          </div>
        </div>

        <!-- GRID -->
        <div class="row g-4" id="galeriContainer">

          <?php foreach ($galeri as $g): ?>

          <div class="col-md-4 galeri-item">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

              <img src="<?= base_url('assets/images/' . html_escape($g->gambar)) ?>"
                   class="card-img-top"
                   style="height:220px; object-fit:cover;">

              <div class="card-body">

                <h5 class="fw-bold mb-0">
                  <?= html_escape($g->judul) ?>
                </h5>

                <small class="text-muted">
                  <?= html_escape($g->gambar) ?>
                </small>

              </div>

              <!-- FOOTER -->
              <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">

                <div class="d-flex gap-2">

                  <!-- EDIT -->
                  <button class="btn btn-warning text-white w-100"
                          data-bs-toggle="modal"
                          data-bs-target="#modalEdit"
                          onclick="editGaleri(<?= $g->id ?>, '<?= html_escape($g->judul) ?>')">
                    <i class="bi bi-pencil-square me-1"></i>
                    Edit
                  </button>

                  <!-- DELETE -->
<?= form_open('Galeri/delete/' . (int)$g->id, [
    'class' => 'd-inline'
]) ?>

<button type="submit" class="btn btn-sm btn-danger rounded-3" onclick="return confirm('Hapus foto ini?')">
    <i class="bi bi-trash3"></i>
</button>

<?= form_close() ?>

                </div>

              </div>

            </div>

          </div>

          <?php endforeach; ?>

        </div>

      </div>
    </div>

  </div>
</div>


<!-- MODAL TAMBAH -->

<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header border-0">
        <h5 class="fw-bold text-primary">Tambah Galeri</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <?= form_open_multipart('Galeri/simpanGaleri') ?>

          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
          </div>

          <div class="text-end">
            <button class="btn btn-light border" data-bs-dismiss="modal">
              Batal
            </button>
            <button class="btn btn-primary">
              Simpan
            </button>
          </div>

        <?= form_close() ?>

      </div>

    </div>
  </div>
</div>

<!-- MODAL UPDATE MY MAN -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header border-0">
        <h5 class="fw-bold text-warning">Edit Galeri</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <?= form_open_multipart('Galeri/updateGaleri') ?>

          <input type="hidden" name="id" id="edit-id">

          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" id="edit-judul" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Ganti Gambar (optional)</label>
            <input type="file" name="gambar" class="form-control">
          </div>

          <div class="text-end">
            <button class="btn btn-light border" data-bs-dismiss="modal">
              Batal
            </button>
            <button class="btn btn-warning text-white">
              Update
            </button>
          </div>

        <?= form_close() ?>

      </div>

    </div>
  </div>
</div>


<script>
function editGaleri(id, judul) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-judul').value = judul;
}

document.getElementById("searchGaleri").addEventListener("keyup", function () {
    let keyword = this.value.toLowerCase();
    document.querySelectorAll(".galeri-item").forEach(item => {
        item.style.display = item.innerText.toLowerCase().includes(keyword)
            ? ""
            : "none";
    });
});
</script>