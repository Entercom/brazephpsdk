<?php

namespace Braze\Messaging\Devices;

interface DeviceObjectInterface {

  static function validFields();

  public function setTitle($title);

  public function setBody($body);
  
}