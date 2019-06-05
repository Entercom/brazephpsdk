<?php

namespace Braze\Messaging;

use Braze\BrazeAccountBase;
use Braze\BrazeRequest;

class PushNotification extends BrazeAccountBase {

  protected $api_path;
  protected $trigger;
  protected $payload;

  public function __construct($base_url, $api_key) {
    parent::__construct($base_url);
    $this->trigger = FALSE;
    $this->setPayload(new MessagePayload($api_key));
  }

  /**
   * Indicates this is part of Braze Triggered API Message.
   * Only needs params if part of an update() or delete() operation.
   * Options should be 'campaign' or 'canvas'.
   *
   * @param string $type
   * @param bool $id
   *
   * @return $this
   */
  public function trigger($type = 'campaign', $id = FALSE) {
    $prop = $type . '_id';
    $this->trigger = array(
      'type' => $type,
      'value' => $id
    );
    if ($id) {
      $this->payload->$prop = $id;
    }
    return $this;
  }

  /**
   * Sends the push Notification.  This will ignore any schedule component
   * and will send the push notification request instantly.
   *
   * Use with caution.
   * 
   * @return array
   */
  public function send() {
    if ($this->trigger) {
      $this->api_path = $this->getTriggerPath() . '/trigger/send';
    }
    else {
      $this->api_path = '/messages/send';
    }
    return $this->request();
  }

  /**
   * Sets the scheduled push notification date/time.
   *
   * @param array $schedule
   *   contains key|values for the following:
   *     "time" => (required, datetime as ISO 8601 string) time to send the message
   *     "in_local_time" => (optional, bool),
   *     "at_optimal_time": (optional, bool),
   * @return $this
   */
  public function schedule($schedule = array()) {
    // Set empty object if not exists.
    if (!isset($this->payload->schedule)){
      $this->payload->schedule = new \stdClass();
    }

    if (isset($schedule['time'])) {
      $this->payload->schedule->time = $schedule['time'];
    }
    if (isset($schedule['in_local_time'])) {
      $this->payload->schedule->is_local_time = !empty($schedule['in_local_time']);
    }
    if (isset($schedule['at_optimal_time'])) {
      $this->payload->schedule->at_optimal_time = !empty($schedule['at_optimal_time']);
    }

    return $this;
  }

  /**
   * Update request.  Only used on scheduled messages.
   *
   * @param string|bool $schedule_id
   * @return array
   */
  public function update($schedule_id = FALSE) {

    if ($schedule_id) {
      $this->payload->schedule_id = $schedule_id;
    }

    if ($this->trigger) {
      $this->api_path = $this->getTriggerPath() . '/trigger/schedule/update';
    }
    else {
      $this->api_path = '/messages/schedule/update';
    }
    return $this->request();
  }

  /**
   * Delete scheduled push request.
   *
   * Only used on scheduled messages.
   *
   * @param string|bool $schedule_id
   * @return array
   */
  public function delete($schedule_id = FALSE) {

    if ($schedule_id) {
      $this->payload->schedule_id = $schedule_id;
    }
    if ($this->trigger) {
      $this->api_path = $this->getTriggerPath() . '/trigger/schedule/delete';
    }
    else {
      $this->api_path = '/messages/schedule/delete';
    }
    return $this->request();
  }

  /**
   * Create scheduled push request.
   *
   * Only used on scheduled messages.
   */
  public function create() {
    $path = '/schedule/create';
    if ($this->trigger) {
      $this->api_path = '/trigger' . $path;
    }
    else {
      $this->api_path = '/messages' . $path;
    }
    return $this->request();
  }

  public function set($type, $var) {
    $this->payload->$type = $var;
  }

  public function get($type) {
    if (isset($this->payload->$type)) {
      return $this->payload->$type;
    }
    return FALSE;
  }

  public function getTrigger() {
    return $this->trigger;
  }

  public function setPayload(MessagePayload $payload) {
    $this->payload = $payload;
  }

  public function getPayload() {
    return $this->payload;
  }

  public function getApiPath() {
    return $this->api_path;
  }

  /**
   * Helper method to get the url path of the trigger type.
   *
   * @return string
   */
  private function getTriggerPath() {
    if ($this->trigger['type'] == 'campaign') {
      return $this->trigger['type'] . 's';
    }
    return $this->trigger['type'];
  }

  private function request() {

    $path = $this->api_path;
    $base_url = $this->base_url;
    $url = rtrim($base_url, '/') . '/' . ltrim($path, '/');
    $method = 'POST';
    $payload = $this->getPayload();

    // unreachable for now so we don't accidentally send pushes while we're
    // still testing.
    $request = new BrazeRequest();
    $request->setUrl($url);
    $request->setMethod($method);
    $request->setPayload($payload);

    return $request->request();

  }


}
