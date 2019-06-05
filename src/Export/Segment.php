<?php

namespace Braze\Export;


class Segment extends ExportBase {

  public function __construct($base_url, $api_key) {
    parent::__construct($base_url, $api_key);
    $this->setType('segments');
    $this->params['api_key'] = $api_key;
  }

  /**
   * @param $type - 'list', 'data_series', 'details'
   * @param string $segment_id - segment_id
   *
   * @return $this
   */
  public function get($type, $segment_id = NULL) {
    $this->setEndpoint($type);
    if (!empty($segment_id)) {
      $this->addParam('segment_id', $segment_id);
    }
    if ($type == 'data_series') {
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