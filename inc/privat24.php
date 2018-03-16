<?php


class PrivatPay
{
	const MERCHANT_ID = '75482';
	const MERCHANT_PASS = '999999';
	const WAIT = 0;
	const TEST = 1;
	const REQUEST_URL = 'https://api.privatbank.ua/p24api/pay_pb';

	private $_card = '4627081718568608';
	private $_amt = '1';
	private $_ccy = 'UAH';
	private $_name = 'test_test';
	private $_crf = '14360570';
	private $_bic = '305299';
	private $_details = 'test%20merch%20not%20active';

	public function setCard($val){
		$this->_card = $val;
	}

	public function setAmt($val){
		$this->_amt = $val;
	}
	
	public function setCcy($val){
		$this->_ccy = $val;
	}
	
	public function setName($val){
		$this->_name = $val;
	}

	public function setCrf($val){
		$this->_crf = $val;
	}

	public function setDetails($val){
		$this->_details = $val;
	}

	public function sendPay(){
		return $this->sendRequest();
	}

	public function _createXml(){
		$xml = new SimpleXMLElement('<request/>');
		$xml->addAttribute('version','1.0');
		$merchant = $xml->addChild('merchant');
		$data = $xml->addChild('data');
		$merchant->addChild('id', self::MERCHANT_ID);
		$merchant->addChild('signature', sha1('b253ad0eafd04aa50398c0b1617b18e5798f2330'));
		$data->addChild('oper','cmt');
		$data->addChild('wait',self::WAIT);
		$data->addChild('test',self::TEST);
		$payment = $data->addChild('payment');
		$payment->addAttribute('id','1234567') ;
		foreach ($this->getProp() as $key => $value) {
			$prop = $payment->addChild('prop');
			$prop->addAttribute('name',$key);
			$prop->addAttribute('value',$value);
		}
		return $xml->asXML();
	}

	public function getProp(){
		return array(
			    "b_card_or_acc" => $this->_card,
                "amt" 			=> $this->_amt,
                "ccy" 			=> $this->_ccy,
                // "b_name" 		=> $this->_name,
                // "b_crf" 		=> $this->_crf,
                // "b_bic" 		=> $this->_bic,
                "details" 		=> $this->_details,
		);
	}

	public function sendRequest(){
		$ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER,  array('Content-Type: text/xml'));
    curl_setopt($ch, CURLOPT_URL, self::REQUEST_URL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_createXml());
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
	}
}

//(new PrivatPay)->sendPay();