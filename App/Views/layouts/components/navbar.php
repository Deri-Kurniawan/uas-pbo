<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow rounded">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= public_path('favicon.png') ?>" width="25em"
        style="margin-right: .1em">epo Calculator</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url('Deposito/about'); ?>">Tentang</a>
        </li>
      </ul>
    </div>
  </div>
</nav>