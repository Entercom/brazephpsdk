<?php

namespace Braze\Messaging\Devices;

class Web extends DevicePushObject {

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
      "custom_uri", // (optional, string) a web URL,
      "image_url", // (optional, string) url for image to show,
      "large_image_url", // (optional, string) url for large image, supported on Chrome Windows/Android,
      "require_interaction", // (optional, boolean) whether to require the user to dismiss the notification, supported on Mac Chrome,
      "time_to_live", // (optional, integer (seconds)),
      "send_to_most_recent_device_only", // (optional, boolean) defaults to false, if set to true, Braze will only send this push to a user's most recently used browser, rather than all eligibles browsers,
      "buttons", // (optional, array of Web Push Action Button Objects) push action buttons to display
    );
  }

}
