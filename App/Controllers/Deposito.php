<?php
included('BaseController', 'c');
included('DepositoModel', 'm');

class Deposito extends BaseController
{
  private $DepositoModel;

  public function __construct()
  {
    $this->DepositoModel = new DepositoModel;
    parent::__construct();
  }

  public function index()
  {
    $historyCalculation = $this->DepositoModel->getCalculationHistory();

    return view('deposito.index', [
      'title'              => 'Deposito Calculation',
      'historyCalculation' => $historyCalculation,
    ]);
  }

  public function calculation()
  {
    $amountMoney  = $this->request->getVar('amount_money');
    $interestRate = $this->request->getVar('interest_rate');
    $timeSpan     = $this->request->getVar('time_span');

    if (is_numeric($amountMoney) && is_numeric($interestRate) && is_numeric($timeSpan)) {
      $result = ($amountMoney * ($interestRate / 100) * $timeSpan);

      $this->DepositoModel->saveCalculationHistory($amountMoney, $interestRate, $timeSpan);

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