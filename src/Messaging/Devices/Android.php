<?php

namespace Braze\Messaging\Devices;

class Android extends DevicePushObject {

  public function __construct($type = FALSE) {
    parent::__construct($type);
  }

  static public function validFields() {
    return array(
      "alert", // (required, string) the notification message,
      "title", // (required, string) the title that appears in the notification drawer,
      "extra", // (optional, object) additional keys and values to be sent in the push,
      "message_variation_id", // (optional, string) used when providing a campaign_id to specify which message variation this message should be tracked under (must be an Android Push Message),
      "notification_channel_id", // (optional, string) the channel ID the notification will be sent with,
      "priority", // (optional, integer) the notification priority value,
      "send_to_sync", // (optional, if set to true we will throw an error if "alert" or "title" is set),
      "collapse_key", // (optional, string) the collapse key for this message,
      // Specifying "default" in the sound field will play the standard notification sound
      "sound", // (optional, string) the location of a custom notification sound within the app,
      "custom_uri", // (optional, string) a web URL, or Deep Link URI,
      "summary_text", // (optional, string),
      "time_to_live", // (optional, integer (seconds)),
      "notification_id", // (optional, integer),
      "push_icon_image_url", // (optional, string) an image URL for the large icon,
      "accent_color", // (optional, integer) accent color to be applied by the standard Style templates when presenting this notification, an RGB integer value,
      "send_to_most_recent_device_only", // (optional, boolean) defaults to false, if set to true, Braze will only send this push to a user's most recently used Android device, rather than all eligible Android devices,
      "buttons", // (optional, array of Android Push Action Button Objects) push action buttons to display
    );
  }

}