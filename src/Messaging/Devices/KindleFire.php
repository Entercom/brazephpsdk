<?php

namespace Braze\Messaging\Devices;

class KindleFire extends DevicePushObject {

  public function __construct($type)
  {
    parent::__construct($type);
  }

  static public function validFields() {
    return array(
      "alert", // (required, string) the notification message,
      "title", // (required, string) the title that appears in the notification drawer,
      "extra", // (optional, object) additional keys and values to be sent in the push,
      "message_variation_id", // (optional, string) used when providing a campaign_id to specify which message variation this message should be tracked under (must be an Kindle/FireOS Push Message),
      "priority", // (optional, integer) the notification priority value,
      "collapse_key", // (optional, string) the collapse key for this message,
      // Specifying "default" in the sound field will play the standard notification sound
      "sound", // (optional, string) the location of a custom notification sound within the app,
      "custom_uri", // (optional, string) a web URL, or Deep Link URI
    );
  }
  
}