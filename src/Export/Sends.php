<?php

namespace Braze\Export;

class Sends extends ExportBase
{

  public function __construct($base_url, $api_key, $campaign_id = NULL, $send_id = NULL) {
    parent::__construct($base_url, $api_key);
    $this->setType('sends');
    $this->setEndpoint('data_series');
    if (!empty($campaign_id)) {
      $this->params['campaign_id'] = $campaign_id;
    }
    if (!empty($send_id)) {
      $this->params['send_id'] = $send_id;
    }
    // make sure required field is set.
    if (empty($this->getParam('length'))) {
      $this->addParam('length', 7);
    }
    $this->params['api_key'] = $api_key;
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