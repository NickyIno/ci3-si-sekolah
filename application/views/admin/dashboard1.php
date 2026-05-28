<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">

  <div class="container-fluid">

    <div class="page-view active">

      <!-- STAT CARDS -->
      <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#ebf0fd;color:var(--primary)">
              <i class="bi bi-newspaper"></i>
            </div>
            <div class="stat-value"><?= $jumlah_artikel; ?></div>
            <div class="stat-label">Total Artikel</div>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#fef9c3;color:#ca8a04">
              <i class="bi bi-images"></i>
            </div>
            <div class="stat-value"><?= $jumlah_carousel; ?></div>
            <div class="stat-label">Carousel Aktif</div>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7;color:#16a34a">
              <i class="bi bi-building"></i>
            </div>
            <div class="stat-value"><?= $jumlah_sarana; ?></div>
            <div class="stat-label">Sarana & Prasarana</div>
          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="stat-card">
            <div class="stat-icon" style="background:#ede9fe;color:#7c3aed">
              <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-value"><?= $jumlah_user; ?></div>
            <div class="stat-label">Total User</div>
          </div>
        </div>

      </div>

      <!-- CONTENT -->
      <div class="row g-3">

        <!-- ARTIKEL -->
        <div class="col-md-7">

          <div class="panel">

            <div class="panel-header d-flex justify-content-between align-items-center">

              <span class="panel-title">
                <i class="bi bi-clock-history text-primary me-2"></i>
                Artikel Terbaru
              </span>

              <button class="btn btn-sm btn-primary">
                <a href="<?= site_url("Artikel") ?>" style="color: white; text-decoration: none; ">Kelola</a>
              </button>

            </div>

            <div class="panel-body">

              <table class="table table-hover">

                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Views</th>
                  </tr>
                </thead>

                <tbody>

                  <?php if (!empty($artikel_baru)): ?>
                    <?php foreach ($artikel_baru as $a): ?>
                      <tr>
                        <td>
                          <span class="fw-semibold">
                            <?= htmlspecialchars($a->judul); ?>
                          </span>
                        </td>

                        <td class="text-muted" style="font-size:12px">
                          <?= $a->tanggal; ?>
                        </td>

                        <td>
                          <span class="badge bg-light text-dark border">
                            <i class="bi bi-eye me-1"></i>
                            <?= $a->viewer; ?>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3" class="text-center text-muted">
                        Tidak ada artikel terbaru
                      </td>
                    </tr>
                  <?php endif; ?>

                </tbody>

              </table>

            </div>

          </div>

        </div>

        <!-- SARANA -->
        <div class="col-md-5">

          <div class="panel">

            <div class="panel-header d-flex justify-content-between align-items-center">

              <span class="panel-title">
                <i class="bi bi-building text-success me-2"></i>
                Sarana Terbaru
              </span>

              <button class="btn btn-sm btn-success">
                <a href="<?= site_url("Sarana") ?>" style="color: white; text-decoration: none; ">Kelola</a>
              </button>

            </div>

            <div class="panel-body">

              <table class="table table-hover">

                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Jml</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>

                  <?php if (!empty($sarana_baru)): ?>
                    <?php foreach ($sarana_baru as $s): ?>
                      <tr>
                        <td class="fw-semibold">
                          <?= html_escape($s->judul); ?>
                        </td>

                        <td>
                          <?= html_escape($s->jumlah); ?>
                        </td>

                        <td>
                          <?php if ($s->keadaan == 'baik'): ?>
                            <span class="badge bg-success">baik</span>
                          <?php else: ?>
                            <span class="badge bg-danger">tidak baik</span>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3" class="text-center text-muted">
                        Tidak ada data sarana
                      </td>
                    </tr>
                  <?php endif; ?>

                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>