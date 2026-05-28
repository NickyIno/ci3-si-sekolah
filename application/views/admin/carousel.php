<!-- MAIN CONTENT -->
<div class="main-content"
     id="mainContent">

  <div class="container-fluid">

    <!-- PAGE -->
    <div class="page-view active"
         id="page-carousel">

      <div class="panel">

        <!-- HEADER -->
        <div class="panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">

          <div>

            <h5 class="fw-bold mb-1">

              <i class="bi bi-images text-primary me-2"></i>
              Carousel / Banner

            </h5>

            <small class="text-muted">
              Kelola banner utama website sekolah
            </small>

          </div>

          <!-- tombol tambah -->
          <button class="btn btn-primary rounded-3 px-3"
                  data-bs-toggle="modal"
                  data-bs-target="#modalCarousel">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Banner

          </button>

        </div>

        <!-- BODY -->
        <div class="panel-body">

          <!-- search -->
          <div class="row mb-3">

            <div class="col-md-4">

              <div class="input-group">

                <span class="input-group-text bg-white">

                  <i class="bi bi-search"></i>

                </span>

                <input type="text"
                       class="form-control"
                       id="searchCarousel"
                       placeholder="Cari banner...">

              </div>

            </div>

          </div>

          <!-- table -->
          <div class="table-responsive">

            <table class="table align-middle">

              <thead class="table-light">

                <tr>

                  <th width="60">#</th>
                  <th width="220">Banner</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th width="120">Aksi</th>

                </tr>

              </thead>

              <tbody id="tbody-carousel">

                <?php foreach ($carousel as $i => $c): ?>

                <tr>

                  <td class="text-muted">
                    <?= $i + 1 ?>
                  </td>

                  <td>

                    <img src="<?= base_url('assets/images/' . $c->gambar) ?>"
                         class="img-fluid rounded-3 border">

                  </td>

                  <td>

                    <div class="fw-semibold">
                      <?= html_escape($c->judul) ?>
                    </div>

                  </td>

                  <td class="text-muted">

                    <?= html_escape($c->deskripsi) ?>

                  </td>

                  <td>

                    <div class="d-flex gap-2">

                      <!-- edit -->
                      <button class="btn btn-sm btn-warning text-white rounded-3"
                              data-bs-toggle="modal"
                              data-bs-target="#modalEditCarousel"
                              onclick="editCarousel(
                                <?= $c->id ?>,
                                '<?= html_escape($c->judul, ENT_QUOTES) ?>',
                                '<?= html_escape($c->deskripsi, ENT_QUOTES) ?>'
                              )">

                        <i class="bi bi-pencil-square"></i>

                      </button>

                      <!-- delete -->
<?= form_open('Carousel/delete/' . (int)$c->id, [
    'class' => 'd-inline'
]) ?>

<button type="submit" class="btn btn-sm btn-danger rounded-3" onclick="return confirm('Hapus banner ini?')">
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

</div>

<!-- MODAL TAMBAH BANNER -->
<div class="modal fade"
     id="modalCarousel"
     tabindex="-1"
     aria-hidden="true">

  <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 rounded-4 shadow">

      <!-- HEADER -->
      <div class="modal-header border-bottom-0 pb-0">

        <div>

          <h4 class="fw-bold mb-1 text-primary">

            <i class="bi bi-images me-2"></i>
            Tambah Banner

          </h4>

          <small class="text-muted">
            Tambahkan carousel/banner website sekolah
          </small>

        </div>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="modal">
        </button>

      </div>

      <!-- BODY -->
      <div class="modal-body pt-3">

        <?= form_open_multipart('Carousel/simpanCarousel') ?>

          <!-- gambar -->
          <div class="mb-3">

            <label class="form-label fw-semibold">
              Upload Banner
            </label>

            <input type="file"
                   class="form-control"
                   name="gambar"
                   required>

          </div>

          <!-- judul -->
          <div class="mb-3">

            <label class="form-label fw-semibold">
              Judul Banner
            </label>

            <input type="text"
                   class="form-control"
                   name="judul"
                   placeholder="Contoh: PPDB 2025"
                   required>

          </div>

          <!-- deskripsi -->
          <div class="mb-3">

            <label class="form-label fw-semibold">
              Deskripsi
            </label>

            <textarea class="form-control"
                      name="deskripsi"
                      rows="4"
                      placeholder="Masukkan deskripsi banner"
                      required></textarea>

          </div>

          <!-- FOOTER -->
          <div class="modal-footer border-top-0">

            <button class="btn btn-light border rounded-3"
                    data-bs-dismiss="modal">

              Batal

            </button>

            <button class="btn btn-primary rounded-3">

              <i class="bi bi-save me-1"></i>
              Simpan Banner

            </button>

          </div>

        <?= form_close() ?>

      </div>

    </div>

  </div>

</div>

<!-- MODAL EDIT BANNER -->
<div class="modal fade"
     id="modalEditCarousel"
     tabindex="-1"
     aria-hidden="true">

  <div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content border-0 rounded-4 shadow">

      <!-- HEADER -->
      <div class="modal-header border-bottom-0 pb-0">

        <div>

          <h4 class="fw-bold mb-1 text-warning">

            <i class="bi bi-images me-2"></i>
            Edit Banner

          </h4>

          <small class="text-muted">
            Ubah data carousel/banner
          </small>

        </div>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="modal">
        </button>

      </div>

      <!-- BODY -->
      <div class="modal-body pt-3">

        <?= form_open_multipart('Carousel/update') ?>

          <input type="hidden" name="id" id="edit-carousel-id">

          <!-- judul -->
          <div class="mb-3">

            <label class="form-label fw-semibold">
              Judul Banner
            </label>

            <input type="text"
                   class="form-control"
                   name="judul"
                   id="edit-carousel-judul"
                   required>

          </div>

          <!-- deskripsi -->
          <div class="mb-3">

            <label class="form-label fw-semibold">
              Deskripsi
            </label>

            <textarea class="form-control"
                      name="deskripsi"
                      id="edit-carousel-deskripsi"
                      rows="4"
                      required></textarea>

          </div>

          <!-- gambar -->
          <div class="mb-3">

            <label class="form-label fw-semibold">
              Ganti Banner (opsional)
            </label>

            <input type="file"
                   class="form-control"
                   name="gambar">

          </div>

          <!-- FOOTER -->
          <div class="modal-footer border-top-0">

            <button class="btn btn-light border rounded-3"
                    data-bs-dismiss="modal">

              Batal

            </button>

            <button class="btn btn-warning text-white rounded-3">

              <i class="bi bi-save me-1"></i>
              Update Banner

            </button>

          </div>

        <?= form_close() ?>

      </div>

    </div>

  </div>

</div>


<script>

function editCarousel(id, judul, deskripsi) {
    document.getElementById('edit-carousel-id').value = id;
    document.getElementById('edit-carousel-judul').value = judul;
    document.getElementById('edit-carousel-deskripsi').value = deskripsi;
}

const searchCarousel = document.getElementById("searchCarousel");

searchCarousel.addEventListener("keyup", function () {

    const keyword = this.value.toLowerCase();

    const rows = document.querySelectorAll("#tbody-carousel tr");

    rows.forEach(row => {

        const text = row.innerText.toLowerCase();

        if (text.includes(keyword)) {

            row.style.display = "";

        } else {

            row.style.display = "none";

        }

    });

});

</script>