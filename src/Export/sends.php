<?php

namespace Braze\Export;

class Sends extends ExportBase
{

  public function __construct($base_url, $api_key) {
    parent::__construct($base_url, $api_key);
    $this->setType('sends');
    $this->setEndpoint('data_series');
    $this->params['api_key'] = $api_key;
  }

  /**
   * @param string $segment_id - segment_id
   *
   * @return $this
   */
  public function get($campaign_id = NULL, $send_id = NULL) {
    if (!empty($campaign_id)) {
      $this->addParam('campaign_id', $campaign_id);
    }
    if (!empty($send_id)) {
      $this->addParam('send_id', $send_id);
    }
    
    // make sure required field is set.
    if (empty($this->getParam('length'))) {
      $this->addParam('length', 7);
    }
    
    return $this;
  }

  /**
   * @param int $number Max number of days before ending_at to include in the
   * returned series - must be between 1 and 100 inclusive
   *
   * @return $this;
   */
  public function length($number = 100) {
    $this->addParam('length', $number);
    return $this;
  }

  /**
   * @param $date DateTime (ISO 8601 string)
   *
   * @return $this;
   */
  public function until($date) {
    $this->addParam('ending_at', $date);
    return $this;
  }
}