# Holmes (version 2.0)

## wat?

Holmes is an easy to use mobile detection library based on php-mobile-detect

## Requirements

* PHP 5.3+

## Usage

    // Determine if request is from a mobile device
    Holmes\Holmes::isMobile(); // returns boolean

    // Determine the type of device
    $device = Holmes\Holmes::getDevice(); // returns string (or default)

    // Holmes\Holmes::getDevice() will throw a DeviceNotDetectedException exception if no default is passed
    // and could not detect a mobile device. Passing a default will return the default in lieu of an
    // exception

    // Determine if a specific device is being used
    // Any supported device below is acceptable
    Holmes\Holmes::isIpad();
    Holmes\Holmes::isBlackberrytablet();

    // Modern (Android/iPad) tablet
    Holmes\Holmes::isTablet();
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
