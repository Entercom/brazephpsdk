<?php

namespace Braze\Messaging\Devices;

class WindowsPhone8 extends DevicePushObject {

  public function __construct($type)
  {
    parent::__construct($type);
  }

  static public function validFields()
  {
    return array(
      "push_type", // (optional, string) must be "toast",
      "toast_title", // (optional, string) the notification title,
      "toast_content", // (required, string) the notification message,
      "toast_navigation_uri", // (optional, string) page uri to send user to,
      "toast_hash", // (optional, object) additional keys and values to send,
      "message_variation_id", // (optional, string) used when providing a campaign_id to specify which message variation this message should be tracked under (must be a Windows Phone 8 Push Message)
    );
  }

  public function setTitle($title) {
    $this->toast_title = $title;
  }

  public function setBody($body) {
    $this->toast_content = $body;
  }
}