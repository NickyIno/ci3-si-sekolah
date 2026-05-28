
<script>
  const toggleBtn = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");

  toggleBtn.addEventListener("click", () => {

    sidebar.classList.toggle("hide");
    mainContent.classList.toggle("full");

  });
</script>

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
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>