<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">

  <div class="container-fluid">

    <div class="panel">

      <!-- HEADER -->
      <div class="panel-header d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div>
          <h5 class="fw-bold mb-1">
            <i class="bi bi-people text-primary me-2"></i>
            Kelola User
          </h5>
          <small class="text-muted">Manajemen pengguna sistem</small>
        </div>

        <button class="btn btn-primary rounded-3"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahUser">
          <i class="bi bi-plus-lg me-1"></i>
          Tambah User
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
              <input type="text" id="searchUser" class="form-control" placeholder="Cari user...">
            </div>
          </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">

          <table class="table align-middle">

            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody id="tbody-user">

              <?php foreach ($users as $i => $u): ?>

              <tr>

                <td><?= $i + 1 ?></td>

                <td>
                  <div class="fw-semibold"><?= html_escape($u->nama) ?></div>
                </td>

                <td>
                  <code class="text-primary"><?= html_escape($u->username) ?></code>
                </td>

                <td>
                  <?php if ($u->role == 'admin'): ?>
                    <span class="badge bg-primary">Admin</span>
                  <?php else: ?>
                    <span class="badge bg-info text-dark">Kontributor</span>
                  <?php endif; ?>
                </td>

                <td>

                  <div class="d-flex gap-2">

                    <!-- EDIT -->
                    <button class="btn btn-sm btn-warning text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#modalEditUser"
                            onclick="editUser(
                              <?= $u->id ?>,
                              '<?= html_escape($u->nama) ?>',
                              '<?= html_escape($u->username) ?>',
                              '<?= $u->role ?>'
                            )">
                      <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- DELETE -->
<?= form_open('KelolaUser/delete/' . (int)$u->id, [
    'class' => 'd-inline'
]) ?>

<button type="submit" class="btn btn-sm btn-danger rounded-3" onclick="return confirm('Hapus user ini?')">
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

<!-- MODAL TAMBAH USER -->
<div class="modal fade" id="modalTambahUser" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold text-primary">Tambah User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('KelolaUser/simpanUser') ?>

        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input class="form-control" name="nama" placeholder="Nama lengkap" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Username</label>
            <input class="form-control" name="username" placeholder="Username untuk login" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" required minlength="6">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Role</label>
            <select class="form-select" name="role" required>
              <option value="">-- Pilih Role --</option>
              <option value="admin">Admin</option>
              <option value="kontributor">Kontributor</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      <?= form_close() ?>

    </div>
  </div>
</div>

<!-- MODAL EDIT USER -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4">

      <div class="modal-header">
        <h5 class="fw-bold text-warning">Edit User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <?= form_open_multipart('KelolaUser/updateUser') ?>

        <div class="modal-body">

          <input type="hidden" name="id" id="edit-user-id">

          <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input class="form-control" name="nama" id="edit-user-nama" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Username</label>
            <input class="form-control" name="username" id="edit-user-username" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
            <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diubah" minlength="6">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Role</label>
            <select class="form-select" name="role" id="edit-user-role" required>
              <option value="admin">Admin</option>
              <option value="kontributor">Kontributor</option>
            </select>
          </div>

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

function editUser(id, nama, username, role) {
  document.getElementById('edit-user-id').value = id;
  document.getElementById('edit-user-nama').value = nama;
  document.getElementById('edit-user-username').value = username;
  document.getElementById('edit-user-role').value = role;
}

document.getElementById("searchUser").addEventListener("keyup", function () {
  let key = this.value.toLowerCase();

  document.querySelectorAll("#tbody-user tr").forEach(row => {
    row.style.display = row.innerText.toLowerCase().includes(key) ? "" : "none";
  });
});

</script>