<?php
namespace Braze\Messaging;

use Braze\Messaging\Devices\DevicePushObject;

class MessagePayload {

  // Need to send something to somewhere.  This is what messages will contain.
  public $messages;
  public $api_key;

  
  public function __construct($api_key) {
    $this->messages = new \stdClass();
    $this->api_key = $api_key;
  }

  public function addPushObject($type, DevicePushObject $message) {
    // Device types
    $device_types = array_keys(DevicePushObject::deviceOptions());
    if (!empty($type) && in_array($type, $device_types)) {
      if (!$message instanceof DevicePushObject) {
        $message = new DevicePushObject($type);
      }
      
      $this->messages->$type = $message;
    }
    else {
      // set warning for disallowed $type
      trigger_error("$type is not an allowed push type", E_USER_WARNING);
    }
  }
  
  public function getPushObject($type) {
    if (!isset($this->messages->$type)) {
      $this->messages->$type = new DevicePushObject($type);
    }
    return $this->messages->$type;
  }

  public function removePushObject($type) {
    if (isset($this->messages->$type)) {
      unset($this->messages->$type);
    }
  }

  public function set($prop, $value) {
    $this->$prop = $value;
  }

  public function get($prop) {
    if (isset($this->$prop)) {
      return $this->$prop;
    }
    return FALSE;
  }
  
  public function getPushMessages() {
    return $this->messages;
  }
  
}