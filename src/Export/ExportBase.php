<?php

namespace Braze\Export;

use Braze\BrazeAccountBase;
use Braze\BrazeRequest;

class ExportBase extends BrazeAccountBase {

  protected $api_path;
  protected $params;
  protected $endpoint;
  protected $method;
  protected $type;
  protected $payload;

  public function __construct($base_url, $api_key) {
    parent::__construct($base_url);
    $this->params = array();
    $this->method = 'GET';
    $this->payload = FALSE;
  }

  public function setEndpoint($endpoint) {
    $this->endpoint = $endpoint;
  }

  public function getEndpoint() {
    return $this->endpoint;
  }

  public function setType($type) {
    $this->type = $type;
  }
  
  public function getType() {
    return $this->type;
  }

  public function addParam($key, $value) {
    $this->params[$key] = $value;
  }

  public function getParam($key) {
    if (isset($this->params[$key])) {
      return $this->params[$key];
    }
    return FALSE;
  }

  public function getParams() {
    return $this->params;
  }
  
  public function getPayload() {
    return $this->payload;
  }
  
  public function setPayload($payload) {
    $this->payload = $payload;
  }

  public function request() {

    $payload = $this->getPayload();
    $params = $this->getParams();

    $path = ltrim($this->getType(), '/');
    $endpoint = ltrim($this->getEndpoint(), '/');
    $base_url = rtrim($this->base_url, '/');
    $url_parts = array(
      $base_url,
      $path,
      $endpoint
    );
    $url = implode('/', $url_parts);

    $request = new BrazeRequest();
    $request->setMethod($this->method);
    $request->setPayload($payload);
    $request->setParams($params);
    $request->setUrl($url);
    
    return $request->request();
    
  }

}