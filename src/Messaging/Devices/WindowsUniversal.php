<?php

namespace Braze\Messaging\Devices;

class WindowsPhone8 extends DevicePushObject {

  public $push_type;
  
  public function __construct($type)
  {
    parent::__construct($type);
    $this->push_type = 'toast_text_01';
  }

  static public function validFields()
  {
    return array(
      "push_type", // (required, string) one of: "toast_text_01", "toast_text_02", "toast_text_03", "toast_text_04", "toast_image_and_text_01", "toast_image_and_text_02", "toast_image_and_text_03", or "toast_image_and_text_04",
      "toast_text1", // (required, string) the first line of text in the template,
      "toast_text2", // (optional, string) the second line of text (for templates with > 1 line of text),
      "toast_text3", // (optional, string) the third line of text (for the *_04 templates),
      "toast_text_img_name", // (optional, string) the path for the image for the templates that include an image,
      "message_variation_id", // (optional, string) used when providing a campaign_id to specify which message variation this message should be tracked under (must be a Windows Universal Push Message),
      "extra_launch_string", // (optional, string) used to add deep linking functionality by passing extra values to the launch string
    );
  }
  
  public function setTitle($title) {
    $this->toast_text1 = $title;
  }

  public function setBody($body) {
    $this->toast_text2 = $body;
  }
}
