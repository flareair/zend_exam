<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

// $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
// $remote = fopen($url, 'r');

// if ($remote) {
//   header("Content-Type: text/xml");
//   while ($chunk = fgets($remote)) {
//     echo $chunk;
//   }
// } else {
//   throw new Exception("Error Processing Request", 1);
// }


class CurrencyApi {
  private $baseApiUri;

  function __construct($uri = 'http://www.cbr.ru/scripts/XML_daily.asp') {
    $this->baseApiUri = $uri;
  }

  private function loadXML($uri) {
    $xmlString = file_get_contents($uri);

    if ($xmlString === false) {
      throw new Exception("Cant get remote server", 1);
      return false;
    }

    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($xmlString);

    if ($xml === false) {
      throw new Exception("Cant parse XML", 1);
      return false;
    }

    return $xml;
  }

  public function getCurrency($date, $currencyList) {
    try {
      $xml = $this->loadXML($this->baseApiUri);
    } catch (Exception $e) {
      return false;
    }
    var_dump($xml);
  }
  public function checkDate() {}
  public function output($date = 'now') {

  }

}


$currencyApi = new CurrencyApi();

$currencyApi->getToday();