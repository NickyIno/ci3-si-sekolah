<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">

  <div class="container-fluid">

    <div class="panel">

      <!-- HEADER -->
      <div class="panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div>
          <h5 class="fw-bold mb-1">
            <i class="bi bi-building text-primary me-2"></i>
            Sarana & Prasarana
          </h5>
          <small class="text-muted">Kelola fasilitas sekolah</small>
        </div>

        <button class="btn btn-primary rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahSarana">
          <i class="bi bi-plus-lg me-1"></i>
          Tambah Data
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
              <input type="text" id="searchSarana" class="form-control" placeholder="Cari sarana...">
            </div>
          </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">

          <table class="table align-middle">

            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Keadaan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody id="tbody-sarana">

              <?php foreach ($sarana as $i => $s): ?>

              <tr>

                <td><?= $i + 1 ?></td>

                <td>
                  <img src="<?= base_url('assets/images/' . $s->gambar) ?>"
                       style="width:120px;height:80px;object-fit:cover;"
                       class="rounded-3 border">
                </td>

                <td>
                  <div class="fw-semibold"><?= htmlspecialchars($s->judul) ?></div>
                </td>

                <td>
                  <span class="badge bg-primary">
                    <?= $s->jumlah ?>
                  </span>
                </td>

                <td>
                  <?php if ($s->keadaan == 'baik'): ?>
                    <span class="badge bg-success">Baik</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Tidak Baik</span>
                  <?php endif; ?>
                </td>

                <td class="text-muted">
                  <?= $s->tanggal ?>
                </td>

                <td>

                  <div class="d-flex gap-2">

                    <!-- EDIT -->
                    <button class="btn btn-sm btn-warning text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditSarana"
                            onclick="editSarana(
                              <?= $s->id ?>,
                              '<?= htmlspecialchars($s->judul, ENT_QUOTES) ?>',
                              <?= $s->jumlah ?>,
                              '<?= $s->keadaan ?>'
                            )">

                      <i class="bi bi-pencil-square"></i>

                    </button>

                    <!-- DELETE -->
<?= form_open('Sarana/delete/' . (int)$s->id, [
    'class' => 'd-inline'
]) ?>

<button type="submit" class="btn btn-sm btn-danger rounded-3" onclick="return confirm('Hapus sarana ini?')">
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

<!-- MODAL TAMBAH -->

<div class="modal fade" id="modalTambahSarana">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold text-primary">Tambah Sarana</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('Sarana/simpanSarana') ?>

        <div class="modal-body">

          <input class="form-control mb-2" name="judul" placeholder="Nama sarana" required>

          <input type="file" class="form-control mb-2" name="gambar" required>

          <input type="number" class="form-control mb-2" name="jumlah" placeholder="Jumlah" required min="0">

          <select class="form-select mb-2" name="keadaan" required>
            <option value="">-- Pilih Keadaan --</option>
            <option value="baik">Baik</option>
            <option value="tidak baik">Tidak Baik</option>
          </select>

        </div>

        <div class="modal-footer">
          <button class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      <?= form_close() ?>

    </div>
  </div>
</div>

<!-- MODAL EDIT -->

<div class="modal fade" id="modalEditSarana">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold text-warning">Edit Sarana</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('Sarana/update') ?>

        <div class="modal-body">

          <input type="hidden" name="id" id="edit-id">

          <input class="form-control mb-2" name="judul" id="edit-judul" required>

          <input type="number" class="form-control mb-2" name="jumlah" id="edit-jumlah" required min="0">

          <select class="form-select mb-2" name="keadaan" id="edit-keadaan" required>
            <option value="baik">Baik</option>
            <option value="tidak baik">Tidak Baik</option>
          </select>

          <!-- PERBAIKAN: tambahkan name='gambar' yang hilang -->
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

function editSarana(id, judul, jumlah, keadaan){
  document.getElementById('edit-id').value = id;
  document.getElementById('edit-judul').value = judul;
  document.getElementById('edit-jumlah').value = jumlah;
  document.getElementById('edit-keadaan').value = keadaan;
}

document.getElementById("searchSarana").addEventListener("keyup", function () {
  let key = this.value.toLowerCase();

  document.querySelectorAll("#tbody-sarana tr").forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(key)
      ? ""
      : "none";
  });
});

</script>