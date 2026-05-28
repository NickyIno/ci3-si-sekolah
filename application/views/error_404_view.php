<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Halaman Tidak Ditemukan</title>
  <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');

    :root {
      --blue-primary: #1a56db;
      --blue-dark:    #1339a0;
      --blue-soft:    #e8f0fe;
      --blue-mid:     #c7d9fb;
    }

    body {
      min-height: 100vh;
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: linear-gradient(135deg, #f0f5ff 0%, #ffffff 60%, #e8f0fe 100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .blob {
      position: fixed;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.18;
      pointer-events: none;
      z-index: 0;
    }
    .blob-1 {
      width: 420px; height: 420px;
      background: var(--blue-primary);
      top: -100px; right: -80px;
    }
    .blob-2 {
      width: 320px; height: 320px;
      background: #93c5fd;
      bottom: -80px; left: -60px;
    }

    .error-card {
      position: relative;
      z-index: 1;
      background: #ffffff;
      border: 1px solid var(--blue-mid);
      border-radius: 20px;
      padding: 3rem 2.5rem;
      max-width: 480px;
      width: 100%;
      box-shadow:
        0 4px 6px -1px rgba(26, 86, 219, 0.07),
        0 20px 40px -8px rgba(26, 86, 219, 0.12);
      animation: cardIn .55s cubic-bezier(.22,1,.36,1) both;
    }

    .error-code {
      font-size: 100px;
      font-weight: 800;
      line-height: 1;
      letter-spacing: -6px;
      background: linear-gradient(135deg, var(--blue-primary) 30%, #60a5fa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: pulse 3s ease-in-out infinite;
    }

    .icon-circle {
      width: 64px; height: 64px;
      background: var(--blue-soft);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 28px;
      color: var(--blue-primary);
      margin: 0 auto .75rem;
    }

    .error-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #0f172a;
    }

    .error-desc {
      font-size: .92rem;
      color: #64748b;
      line-height: 1.65;
    }

    .info-box {
      background: var(--blue-soft);
      border-left: 3px solid var(--blue-primary);
      border-radius: 0 8px 8px 0;
      padding: .85rem 1.1rem;
      font-size: .86rem;
      color: var(--blue-dark);
      text-align: left;
    }

    .divider {
      border-color: var(--blue-mid);
      opacity: 1;
    }

    .btn-home {
      background: var(--blue-primary);
      border: none;
      border-radius: 10px;
      font-weight: 700;
      font-size: .92rem;
      padding: .6rem 1.6rem;
      letter-spacing: .02em;
      transition: background .2s, transform .15s, box-shadow .2s;
      box-shadow: 0 4px 12px rgba(26, 86, 219, .28);
    }
    .btn-home:hover {
      background: var(--blue-dark);
      transform: translateY(-1px);
      box-shadow: 0 8px 18px rgba(26, 86, 219, .35);
    }
    .btn-home:active {
      transform: translateY(0);
    }

    .badge-code {
      background: var(--blue-soft);
      color: var(--blue-primary);
      font-weight: 700;
      font-size: .72rem;
      border-radius: 6px;
      padding: .18rem .55rem;
      letter-spacing: .06em;
    }
  </style>
</head>
<body>

  <!-- Decorative blobs -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>

  <div class="error-card text-center">

    <!-- Badge -->
    <div class="mb-3">
      <span class="badge-code">ERROR</span>
    </div>

    <!-- 404 number -->
    <div class="error-code">404</div>

    <!-- Icon -->
    <div class="icon-circle mt-2">
      <i class="bi bi-map"></i>
    </div>

    <!-- Title & description -->
    <h1 class="error-title mb-2">Halaman Tidak Ditemukan</h1>
    <p class="error-desc mb-3">
      Halaman yang Anda cari tidak tersedia atau telah dipindahkan.<br>
      Periksa kembali URL yang Anda masukkan.
    </p>

    <!-- Info box -->
    <div class="info-box mb-4">
      <i class="bi bi-info-circle-fill me-1"></i>
      URL yang Anda akses tidak terdaftar dalam sistem. Pastikan alamat yang dimasukkan sudah benar, atau kembali ke halaman utama.
    </div>

    <!-- Actions -->
    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-center">
      <a href="<?= base_url() ?>" class="btn btn-home btn-primary text-white">
        <i class="bi bi-house-door-fill me-1"></i> Kembali ke Beranda
      </a>
      <a href="javascript:history.back()" class="btn btn-outline-primary rounded-3 fw-semibold" style="font-size:.92rem; padding:.6rem 1.4rem;">
        <i class="bi bi-arrow-left me-1"></i> Halaman Sebelumnya
      </a>
    </div>

    <p class="mt-4 mb-0" style="font-size:.78rem; color:#94a3b8;">
      Jika masalah terus berlanjut, hubungi administrator sistem.
    </p>

  </div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>