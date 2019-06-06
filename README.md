# brazephpsdk
PHP SDK for Braze

# Examples

Send a Push Message immediately:
```php
$base_url = 'https://rest.iad-03.braze.com';
$api_key = 'some-api-key-123456789'

// Create new push object
$push_notification = new \Braze\Messaging\PushNotification($base_url, $api_key);
// add a Segment ID
$push_notification->getPayload()->set('segment_id', $config['segment_id']);
// set Broadcast to TRUE
$push_notification->getPayload()->set('broadcast', TRUE);

// apple, android, windows_phone8, kindle_fire, windows_universal
$device_type = 'apple';
$type = $push_notification->getPayload()->getPushObject($device_type)->getType();
// grabs the device classname based on the device type
$classname = $push_notification->getPayload()->getPushObject($type)->objectMap($type);
// the device-specific class name, including namespace
$device_class = "Braze\\Messaging\\Devices\\$classname";

// create a device-specific push object
$push_notification->getPayload()->addPushObject($type, new $device_class($type));
// set push title.  Has a specific setter for title defined by interface
$push_notification->getPayload()->getPushObject($type)->setTitle('I am the title!');
// set push body.  Has a specific setter for body as defined by interface
$push_notification->getPayload()->getPushObject($type)->setBody('here is my body message');
// set badge. uses set method for adding other device-specific properties
$push_notification->getPayload()->getPushObject($type)->set('badge', 1);

// send the message
$push_notification->send();

```