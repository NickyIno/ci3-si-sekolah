<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">

  <div class="container-fluid">

    <div class="panel">

      <!-- HEADER -->
      <div class="panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div>
          <h5 class="fw-bold mb-1">
            <i class="bi bi-newspaper text-primary me-2"></i>
            Artikel & Berita
          </h5>
          <small class="text-muted">Kelola artikel sekolah</small>
        </div>

        <button class="btn btn-primary rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahArtikel">
          <i class="bi bi-plus-lg me-1"></i>
          Tambah Artikel
        </button>

      </div>

      <!-- BODY -->
      <div class="panel-body">

        <!-- SEARCH -->
        <div class="row mb-3">
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-text bg-white">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" id="searchArtikel" class="form-control" placeholder="Cari artikel...">
            </div>
          </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">

          <table class="table align-middle">

            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Artikel</th>
                <th>Slug</th>
                <th>Tanggal</th>
                <th>Views</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody id="tbody-artikel">

              <?php foreach ($artikel as $i => $a): ?>

              <tr>

                <td><?= $i + 1 ?></td>

                <td>
                  <div class="fw-semibold"><?= html_escape($a->judul) ?></div>

                  <small class="text-muted">
                    <img src="<?= base_url('assets/images/' . $a->gambar) ?>"
                         width="40"
                         class="rounded me-2">
                    <?= html_escape($a->deskripsi) ?>
                  </small>
                </td>

                <td>
                  <code class="text-primary"><?= html_escape($a->slug) ?></code>
                </td>

                <td><?= $a-> tanggal ?></td>

                <td>
                  <span class="badge bg-light text-dark border">
                    <i class="bi bi-eye me-1"></i>
                    <?= $a->viewer ?>
                  </span>
                </td>

                <td>

                  <div class="d-flex gap-2">

                    <!-- EDIT -->
                    <button class="btn btn-warning btn-sm text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditArtikel"
                            onclick="editArtikel(
                              <?= $a->id ?>,
                              '<?= html_escape($a->judul) ?>',
                              '<?= html_escape($a->slug) ?>',
                              '<?= html_escape($a->deskripsi) ?>'
                            )">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- DELETE -->
<?= form_open('artikel/delete/' . (int)$a->id, [
    'class' => 'd-inline'
]) ?>

<button type="submit" class="btn btn-sm btn-danger rounded-3" onclick="return confirm('Hapus artikel ini?')">
    <i class="bi bi-trash3"></i>
</button>

<?= form_close() ?>
                  </div>

                </td>

              </tr>

              <?php endforeach; ?>

            </tbody>

          </table>

        </div>

      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="modalTambahArtikel">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold">Tambah Artikel</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('Artikel/tambah') ?>

        <div class="modal-body">

          <input class="form-control mb-2" name="judul" placeholder="Judul" required>
          <input class="form-control mb-2" name="slug" placeholder="Slug" required>

          <input type="file" class="form-control mb-2" name="gambar" required>

          <textarea class="form-control" name="deskripsi" rows="5" required></textarea>

        </div>

        <div class="modal-footer">
          <button class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      <?= form_close() ?>

    </div>
  </div>
</div>

<div class="modal fade" id="modalEditArtikel">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold text-warning">Edit Artikel</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('Artikel/update') ?>

        <div class="modal-body">

          <input type="hidden" name="id" id="edit-id">

          <input class="form-control mb-2" name="judul" id="edit-judul" required>
          <input class="form-control mb-2" name="slug" id="edit-slug" required>

          <textarea class="form-control mb-2" name="deskripsi" id="edit-deskripsi" required></textarea>

          <input type="file" class="form-control" name="gambar">

        </div>

        <div class="modal-footer">
          <button class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-warning text-white">Update</button>
        </div>

      <?= form_close() ?>

    </div>
  </div>
</div>

<script>
function editArtikel(id, judul, slug, deskripsi) {
  document.getElementById('edit-id').value = id;
  document.getElementById('edit-judul').value = judul;
  document.getElementById('edit-slug').value = slug;
  document.getElementById('edit-deskripsi').value = deskripsi;
}

document.getElementById("searchArtikel").addEventListener("keyup", function () {
  let key = this.value.toLowerCase();
  document.querySelectorAll("#tbody-artikel tr").forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(key) ? "" : "none";
  });
});

</script>