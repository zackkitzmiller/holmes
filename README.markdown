# Holmes (version 1.2)

## wat?

Holmes is an easy to use mobile detection library based on php-mobile-detect

## Requirements

* PHP 5.3+

## Usage

    // Determine if request is from a mobile device
    Holmes::is_mobile(); // returns boolean

    // Determine the type of device
    $device = Holmes::get_device(); // returns string (or default)

    // Holmes::get_device() will throw a DeviceNotDetectedException exception if no default is passed
    // and could not detect a mobile device. Passing a default will return the default in lieu of an
    // exception

    // Determine if a specific device is being used
    // Any supported device below is acceptable
    // lowercased no spaces, obviously. <3
    Holmes::is_ipad();
    Holmes::is_blackberrytablet();

    // Modern (Android/iPad) tablet
    Holmes::is_tablet();
## Supported Device Types

* Android
* Android Tablet
* BlackBerry
* BlackBerry Tablet
* iPhone
* iPad
* iOS (any iOS device)
* Nintendo DS/DSi
* Palm
* Windows
* Windows Phone
* More generic text-only devices
