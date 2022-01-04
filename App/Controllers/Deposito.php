<?php
included('BaseController', 'c');

class Deposito extends BaseController
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $historyCalculation = Database::connect()->query("SELECT * FROM `history_calculation`");

    $hc = array();

    while ($row = mysqli_fetch_assoc($historyCalculation)) {
      $hc[] = $row;
    }

    return view('deposito.index', [
      'title' => 'Deposito Calculation',
      'historyCalculation' => $hc,
    ]);
  }

  public function calculation()
  {
    $amountMoney  = $this->request->getVar('amount_money');
    $interestRate = $this->request->getVar('interest_rate');
    $timeSpan     = $this->request->getVar('time_span');

    if (is_numeric($amountMoney) && is_numeric($interestRate) && is_numeric($timeSpan)) {

      $result = ($amountMoney * ($interestRate / 100) * $timeSpan);

      Database::connect()->query("INSERT INTO `history_calculation` VALUES (null, $amountMoney, $interestRate, $timeSpan)");

      return redirect("deposito/?amountMoney=$amountMoney&interestRate=$interestRate&timeSpan=$timeSpan&result=$result");
    } else {
      $errorMessage = 'Input harus berupa angka';
      return redirect("deposito/?errorMessage=$errorMessage&amv=$amountMoney&irv=$interestRate&tsv=$timeSpan");
    }
  }

  public function about()
  {
    return redirectOut('https://github.com/Deri-Kurniawan/uas-pbo');
  }
}