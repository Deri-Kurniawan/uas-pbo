<?= addComponent('layouts.components.header', $title); ?>
<?= addComponent('layouts.components.navbar'); ?>

<main>
  <div class="container">
    <div class="col-12 col-md-8 offset-md-2">
      <h2 class="text-center my-1">Kalkulator Deposito</h2>

      <?php if (isset($_GET['successMessage'])) : ?>
      <div class="alert alert-success alert-dismissible fade show text-center">
        <?= $_GET['successMessage']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <?php if (isset($_GET['errorMessage'])) : ?>
      <div class="alert alert-danger alert-dismissible fade show text-center">
        <?= $_GET['errorMessage']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <?php if (isset($_GET['result'])) : ?>
      <div class="alert alert-success alert-dismissible fade show text-center">
        Rp<?= number_format($_GET['amountMoney'], 2) ?> ×
        <?= $_GET['interestRate']; ?>% ×
        <?= $_GET['timeSpan']; ?> Tahun = <span
          class="text-decoration-underline">Rp<?= number_format($_GET['result'], 2); ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif ?>

      <form action="<?= base_url('Deposito/calculation'); ?>" method="post">
        <div class="mt-2">
          <label for="amount_money">Jumlah Uang</label>
          <input type="number" name="amount_money" id="amount_money" class="form-control"
            value="<?= isset($_GET['amv']) ? $_GET['amv'] : ''; ?>" placeholder="Masukan angka" required>
        </div>
        <div class="row">
          <div class="col-12 mt-2 col-sm-6">
            <label for="interest_rate">Suku Bunga</label>
            <div class="input-group">
              <input type="interest_rate" name="interest_rate" id="interest_rate" class="form-control"
                value="<?= isset($_GET['irv']) ? $_GET['irv'] : ''; ?>" placeholder="Masukan angka" required>
              <span class="input-group-text">%</span>
            </div>
          </div>
          <div class="col-12 mt-2 col-sm-6">
            <label for="time_span">Jangka Waktu</label>
            <div class="input-group">
              <input type="time_span" name="time_span" id="time_span" class="form-control"
                value="<?= isset($_GET['tsv']) ? $_GET['tsv'] : ''; ?>" placeholder="Masukan angka" required>
              <span class="input-group-text">Tahun</span>
            </div>
          </div>
        </div>
        <button type="submit" class="col-4 offset-4 my-4 btn btn-outline-primary text-center">
          Kalkulasi
        </button>
      </form>

      <hr>

      <h2 class="text-center my-2">Sejarah Kalkulasi</h2>
      <?php if (is_array($historyCalculation) && count($historyCalculation) > 0) : ?>
      <form action="<?= base_url('Deposito/clearHistory'); ?>" method="POST">
        <button type="submit" class="btn btn-outline-danger mb-3"
          onclick="return confirm('Data tidak akan pernah dapat dikembalikan.\nyakin ingin membersihkan?')">Bersihkan
          Sejarah</button>
      </form>
      <?php endif ?>
      <div class="col-12 overflow-scroll">
        <table class="table table-hover table-bordered">
          <tr class="table-primary">
            <th>No.</th>
            <th>Jumlah uang</th>
            <th>Suku Bunga</th>
            <th>Jangka Waktu</th>
            <th>Keuntungan</th>
          </tr>
          <?php if (is_array($historyCalculation) && count($historyCalculation) > 0) : ?>
          <?php $no = 1 ?>
          <?php foreach ($historyCalculation as $hc) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td>Rp<?= number_format($hc['amount_money'], 2); ?></td>
            <td><?= $hc['interest_rate']; ?>%</td>
            <td><?= $hc['time_span']; ?> Tahun</td>
            <td>
              Rp<?= number_format($hc['amount_money'] * ($hc['interest_rate'] / 100) * $hc['time_span'], 2); ?>
            </td>
          </tr>
          <?php endforeach ?>
          <?php else : ?>
          <tr>
            <td class="alert alert-danger text-center" colspan="5">Tidak ada data!</td>
          </tr>
          <?php endif ?>
        </table>
      </div>
    </div>
  </div>
</main>

<?= addComponent('layouts.components.footer'); ?>