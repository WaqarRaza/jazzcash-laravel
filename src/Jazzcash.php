<?php

namespace Waqarraza\Jazzcashlaravel;

class Jazzcash
{
  private static $instance;

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function checkout($amount, $description = 'Sample Description') {
    $data =  $this->makeRequest($amount, $description);
    return view('Waqarraza::checkout')->with('post_data',$data);
  }

  private function makeRequest($amount, $description) {
    $pp_Amount = (int)round($amount, 0);
    $pp_Amount *= 100;
    $pp_TxnDateTime = (new \DateTime);
    $pp_TxnExpiryDateTime = $pp_TxnDateTime->add(new \DateInterval('PT' . config('jazzcash.expire_after') . 'M'))->format('YmdHis');
    $pp_TxnRefNo = 'T' . time();


    $data = [
        "pp_TxnType" => "MWALLET",
        "pp_Version" => config('jazzcash.version'),
        "pp_Language" => "EN",
        "pp_MerchantID" => config('jazzcash.merchant_id'),
        "pp_SubMerchantID" => config('jazzcash.sub_merchant_id', ''),
        "pp_Password" => config('jazzcash.password'),
        "pp_TxnRefNo" => $pp_TxnRefNo,
        "pp_BankID" => "TBANK",
        "pp_ProductID" => "RETL",
        "pp_Amount" => $pp_Amount,
        "pp_TxnCurrency" => "PKR",
        "pp_TxnDateTime" => $pp_TxnDateTime->format('YmdHis'),
        "pp_BillReference" => "billRef",
        "pp_Description" => $description,
        "pp_TxnExpiryDateTime" => $pp_TxnExpiryDateTime,
        "pp_ReturnURL" => config('jazzcash.return_url'),
        "pp_SecureHash" => "",
        "ppmpf_1" => "1",
        "ppmpf_2" => "2",
        "ppmpf_3" => "3",
        "ppmpf_4" => "4",
        "ppmpf_5" => "5",
    ];
    $data['pp_SecureHash'] = $this->get_hash($data);

    return $data;
  }

  private function get_hash($data) {
    ksort($data);
    $str = '';

    foreach ($data as $key => $value) {
      if (!empty($value)) {
        $str = $str . '&' . $value;
      }
    }
    $salt = config('jazzcash.integrity_salt');
    $str = $salt . $str;

    return hash_hmac('sha256', $str, $salt);
  }

}
