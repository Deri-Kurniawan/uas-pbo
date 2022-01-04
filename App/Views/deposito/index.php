<?= templateEngine('layouts.components.header', $title); ?>
<?= templateEngine('layouts.components.navbar'); ?>

<main>
  <div class="container">
    <div class="col-8 offset-2">
      <h1 class="text-center">Kalkulator Deposito</h1>
      <?php if(isset($_GET['errorMessage'])) : ?>
      <div class="alert alert-danger text-center"><?= $_GET['errorMessage']; ?></div>
      <?php endif ?>

      <?php if(isset($_GET['result'])) : ?>
      <div class="my-4 text-center">
        Rp<?= number_format($_GET['amountMoney'], 2) ?> ×
        <?= $_GET['interestRate']; ?>% ×
        <?= $_GET['timeSpan']; ?> Tahun = Rp<?= number_format($_GET['result'], 2); ?>
      </div>
      <?php endif ?>

      <form action="<?= base_url('Deposito/calculation'); ?>" method="post">
        <div class="mt-2">
          <label for="amount_money">Jumlah Uang</label>
          <input type="number" name="amount_money" id="amount_money" class="form-control"
            value="<?= isset($_GET['amv']) ? $_GET['amv'] : ''; ?>" placeholder="Jumlah Uang" required>
        </div>
        <div class="row">
          <div class="col-6 mt-2">
            <label for="interest_rate">Suku Bunga</label>
            <div class="input-group">
              <input type="interest_rate" name="interest_rate" id="interest_rate" class="form-control"
                value="<?= isset($_GET['irv']) ? $_GET['irv'] : ''; ?>" placeholder="Suku Bunga" required>
              <span class="input-group-text">%</span>
            </div>
          </div>
          <div class="col-6 mt-2">
            <label for="time_span">Jangka Waktu</label>
            <div class="input-group">
              <input type="time_span" name="time_span" id="time_span" class="form-control"
                value="<?= isset($_GET['tsv']) ? $_GET['tsv'] : ''; ?>" placeholder="Jangka Waktu" required>
              <span class="input-group-text">Tahun</span>
            </div>
          </div>
        </div>
        <button type="submit" class="col-4 offset-4 my-4 btn btn-outline-primary text-center">
          Kalkulasi
        </button>
      </form>

      <hr>

      <h2 class="text-center my-4">Sejarah Kalkulasi</h2>
      <table class="table table-hover table-bordered">
        <tr class="table-primary">
          <th>No.</th>
          <th>Jumlah uang</th>
          <th>Suku Bunga</th>
          <th>Jangka Waktu</th>
          <th>Keuntungan</th>
        </tr>
        <?php if(is_array($historyCalculation) && count($historyCalculation) > 0) : ?>
        <?php $no = 1 ?>
        <?php foreach($historyCalculation as $hc) : ?>
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
</main>

<?= templateEngine('layouts.components.footer'); ?>