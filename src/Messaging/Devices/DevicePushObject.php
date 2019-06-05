<?php

namespace Braze\Messaging\Devices;

class DevicePushObject implements DeviceObjectInterface {

  private $device_type;

  public function __construct($device_type) {
    $class = $this->objectMap($device_type);
    $full_class = "\\Braze\\Messaging\\Devices\\$class";

    if (!class_exists($full_class)) {
      // set warning for disallowed $type.
      trigger_error("$device_type is not an allowed device type", E_USER_WARNING);
    }

    $this->setType($device_type);
  }

  public function setType($device_type) {
    $this->device_type = $device_type;
  }

  public function getType() {
    return $this->device_type;
  }
  
  public function set($property, $data) {
    $device_type = $this->getType();
    $class = $this->objectMap($device_type);
    $full_class = "\\Braze\\Messaging\\Devices\\$class";
    $allowed_field = $full_class::validFields();
    if (in_array($property, $allowed_field)) {
      $this->$property = $data;
    }
    else {
      // @todo set error: field not allowed.
      trigger_error("$property is not a valid field for $device_type message object", E_USER_WARNING);
    }
  }

  public function get($property) {
    if (isset($this->$property)) {
      return $this->$property;
    }
    return FALSE;
  }

  public function objectMap($device_type) {
    $deviceMap =  $this->deviceOptions();
    if (isset($deviceMap[$device_type])) {
      return $deviceMap[$device_type];
    }
    return FALSE;
  }

  static public function deviceOptions() {
    return array(
      // push type => className
      "apple" => 'Apple',
      "android" => 'Android',
      "kindle" => 'KindleFire',
      "web" => 'Web',
      "windows_phone8" => 'WindowsPhone8',
      "windows_universal" => 'WindowsUniversal',
    );
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function setBody($body) {
    $this->alert = $body;
  }

  static function validFields() {}
  
  
}