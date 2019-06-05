<?php

namespace Braze\Export;

class Campaign extends ExportBase
{

  public function __construct($base_url, $api_key) {
    parent::__construct($base_url, $api_key);
    $this->setType('campaigns');
    $this->params['api_key'] = $api_key;
  }

  /**
   * @param $endpoint - 'list', 'data_series', 'details'
   * @param string $segment_id - segment_id
   *
   * @return $this
   */
  public function get($endpoint, $segment_id = NULL) {
    $this->setEndpoint($endpoint);
    if (!empty($segment_id)) {
      $this->addParam('campaign_id', $segment_id);
    }
    if ($endpoint == 'data_series') {
      // make sure required field is set.
      if (empty($this->getParam('length'))) {
        $this->addParam('length', 7);
      }
    }
    return $this;
  }

  public function sort($type = 'asc') {
    $this->addParam('sort_direction', $type);
    return $this;
  }

  public function page($number = 1) {
    $this->addParam('page', $number);
    return $this;
  }

  public function includeArchived($bool = TRUE) {
    $this->addParam('include_archived', (boolean)json_decode(strtolower($bool)));
    return $this;
  }

  /**
   * @param int $number Max number of days before ending_at to include in the
   * returned series - must be between 1 and 100 inclusive
   *
   * @return $this;
   */
  public function length($number = 1) {
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