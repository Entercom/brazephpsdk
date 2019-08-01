<?php

namespace Braze;

class BrazeAccountBase {

  /**
   * @var string Current version of the SDK
   */
  const VERSION = '0.0.3';

  /**
   * @var string
   */
  public $base_url;


  public function __construct($base_url) {
    $this->base_url = $base_url;
  }

  public function getBaseUrl() {
    return $this->base_url;
  }

}
