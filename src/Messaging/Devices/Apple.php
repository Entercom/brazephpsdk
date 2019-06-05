<?php

namespace Braze\Messaging\Devices;

class Apple extends DevicePushObject {

  public $alert;

  public function __construct($type = FALSE) {
    parent::__construct($type);
    $this->alert = new \stdClass();
    $this->extra = new \stdClass();
  }

  static public function alertFields() {
    return array(
      "body", // (required unless content-available is true in the Apple Push Object, string) the text of the alert message,
      "title", // (optional, string) a short string describing the purpose of the notification, displayed as part of the Apple Watch notification interface,
      "title_loc_key", // (optional, string) the key to a title string in the `Localizable.strings` file for the current localization,
      "title_loc_args", // (optional, array of strings) variable string values to appear in place of the format specifiers in title_loc_key,
      "action_loc_key", // (optional, string) if a string is specified, the system displays an alert that includes the Close and View buttons, the string is used as a key to get a localized string in the current localization to use for the right button’s title instead of "View",
      "loc_key", // (optional, string) a key to an alert-message string in a Localizable.strings file for the current localization,
      "loc_args", //(optional, array of strings) variable string values to appear in place of the format specifiers in loc_key
    );
  }
  
  public function setTitle($title) {
    $this->alert->title = $title;
  }
  
  public function setBody($body) {
    $this->alert->body = $body;
  }

  static public function validFields() {
    return array(
      "badge", // (optional, int) the badge count after this message,
      "alert", // (required unless content-available is true, string or Apple Push Alert Object) the notification message,
      // Specifying "default" in the sound field will play the standard notification sound
      "sound", // (optional, string) the location of a custom notification sound within the app,
      "extra", // (optional, object) additional keys and values to be sent,
      "content-available", // (optional, boolean) if set, Braze will add the "content-available" flag to the push payload,
      "expiry", // (optional, ISO 8601 date string) if set, push messages will expire at the specified datetime,
      "custom_uri", // (optional, string) a web URL, or Deep Link URI,
      "message_variation_id", // (optional, string) used when providing a campaign_id to specify which message variation this message should be tracked under (must be an iOS Push Message),
      "notification_group_thread_id", // (optional, string) the notification group thread ID the notification will be sent with,
      "asset_url", // (optional, string) content URL for rich notifications for devices using iOS 10 or higher,
      "asset_file_type", // (required if asset_url is present, string) file type of the asset - one of "aif", "gif", "jpg", "m4a", "mp3", "mp4", "png", or "wav",
      "collapse_id", // (optional, string) To update a notification on the user's device once you've issued it, send another notification with the same collapse ID you used previously
      "mutable_content", // (optional, boolean) if true, Braze will add the mutable-content flag to the payload and set it to 1. The mutable-content flag is automatically set to 1 when sending a rich notification, regardless of the value of this parameter.
      "send_to_most_recent_device_only", // (optional, boolean) defaults to false, if set to true, Braze will only send this push to a user's most recently used iOS device, rather than all eligible iOS devices,
      "category", // (optional, string) the iOS notification category identifier for displaying push action buttons,
      "buttons" // (optional, array of Apple Push Action Button Objects) push action buttons to display
    );
  }

}