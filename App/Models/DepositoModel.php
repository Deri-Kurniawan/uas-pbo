<?php
require_once SYSTEMPATH . 'Database.php';

class DepositoModel extends Database
{
  private $table = 'history_calculation';

  public function saveCalculationHistory($amountMoney, $interestRate, $timeSpan)
  {
    return $this->connect()->query("INSERT INTO `{$this->table}` VALUES (null, $amountMoney, $interestRate, $timeSpan)");
  }

  public function getCalculationHistory()
  {
    $result = $this->connect()->query("SELECT * FROM `{$this->table}`");

    $arrayAssoc = $this->makeArrayAssoc($result);

    return $arrayAssoc;
  }

  public function clearHistory()
  {
    return $this->connect()->query("DELETE FROM {$this->table}");
  }
}