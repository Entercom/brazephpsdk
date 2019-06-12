<?php

namespace Braze;

class BrazeRequest {

  protected $payload;
  protected $params;
  protected $url;
  protected $method;

  public function __construct() {
    $this->method = 'GET';
    $this->params = array();
  }

  public function setMethod($method = 'GET') {
    $this->method = $method;
  }

  public function getMethod() {
    return $this->method;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function getUrl() {
    if (isset($this->url)) {
      return $this->url;
    }
    return FALSE;
  }

  public function setPayload($payload = NULL) {
    $this->payload = $payload;
  }

  public function getPayload() {
    if (isset($this->payload)) {
      return $this->payload;
    }
    return FALSE;
  }

  public function setParams($params = array()) {
    $this->params = $params;
  }

  public function getParams() {
    return $this->params;
  }

  public function buildQuery($params) {
    if (!empty($params)) {
      return \http_build_query($params);
    }
    return FALSE;
  }

  public function request() {

    $url = $this->getUrl();
    $payload = $this->getPayload();
    $method = $this->getMethod();
    $params = $this->getParams();
    $query = $this->buildQuery($params);
    if (!empty($query)) {
      $url = $url . '?' . $query;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout after 10 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if (strtoupper($method) == 'POST') {
      $data = json_encode($payload);
      $headers  = [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data),
      ];
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $result = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close ($ch);

    return array(
      'response' => $result,
      'code' => $status_code,
    );
  }
  
}