<div class="container d-flex justify-content-center align-items-center min-vh-100">

  <?= form_open('User/cek_login', [
      'class' => 'w-100',
      'style' => 'max-width: 400px; margin-top: -60px;'
  ]); ?>

    <img 
      src="<?= base_url('assets/images/' . $profil->logo) ?>" 
      width="120" 
      height="120" 
      class="d-block mx-auto img-thumbnail mb-3 border-0" 
      alt="..."
    >

<h3>Selamat datang di halaman login</h3>

    <div class="form-group mb-3">
      <label for="exampleInputUsername1">
        Username
      </label>

      <input 
        type="text" 
        class="form-control" 
        id="exampleInputUsername1" 
        name="username" 
        required
      >

      <small class="form-text text-muted">
        Username
      </small>
    </div>

    <div class="form-group mb-3">
      <label for="exampleInputPassword1">
        Password
      </label>

      <input 
        type="password" 
        name="password" 
        class="form-control" 
        id="exampleInputPassword1" 
        required
      >
    </div>

    <button 
      type="submit" 
      class="btn btn-primary w-100"
    >
      Submit
    </button>

  <?= form_close(); ?>
  
</div>