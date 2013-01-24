<?php

namespace Holmes;

use BadMethodCallException;

class DeviceNotDetectedException extends \Exception {}

/**
* Holmes
* Based On http://code.google.com/p/php-mobile-detect/
* @modified Zack Kitzmiller
*/
class Holmes
{
    /**
     * @var  array  $devices  regex and patterns from php-mobile-detect
     */
    protected static $devices = array(
        "android"           => "android.*mobile",
        "androidtablet"     => "android.*chrome/[.0-9]* (mobile)?",
        "blackberry"        => "blackberry",
        "blackberrytablet"  => "rim tablet os",
        "iphone"            => "(iphone|ipod)",
        "ipad"              => "(ipad)",
        "ios"               => "(iphone|ipod|ipad)",
        "chromeios"         => "CriOS",
        'nintendo'          => "(nintendo dsi|nintendo ds)",
        "palm"              => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows"           => "windows ce; (iemobile|ppc|smartphone)",
        "windowsphone"      => "windows phone os",
        "generic"           => "(kindle|mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
    );

    /**
     * Magic tester method.
     *
     * @param   string   $name       method name
     * @param   array    $arguments  method arguments
     * @return  boolean  static::isDevice result
     */
    public static function __callStatic($name, $arguments)
    {
        $parts = preg_split('/(?=[A-Z])/', $name);
        $device = strtolower(array_pop($parts));

        if (array_key_exists($device, static::$devices))
        {
            return static::isDevice($device);
        }
        else
        {
            throw new BadMethodCallException('Invalid method called.');
        }
    }

    /**
     * Detect wether it's a tablet device
     *
     * @return  boolean  wether it's a tablet device
     */
    public static function isTablet()
    {
        return static::isAndroidtablet() || static::isIpad();
    }

    /**
     * Detect wether it's a mobile device
     *
     * @return  boolean  wether it's a mobile device
     */
    public static function isMobile()
    {
        $accept = $_SERVER['HTTP_ACCEPT'];

        if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))
        {
            return true;
        }
        elseif (strpos($accept, 'text/vnd.wap.wml') > 0 || strpos($accept, 'application/vnd.wap.xhtml+xml') > 0)
        {
            return true;
        }

        foreach (array_keys(static::$devices) as $device)
        {
            if (static::isDevice($device))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve the device type
     *
     * @param   boolean  $default  default device
     * @return  string   device name
     * @throws  Holmes\DeviceNotDetectedException
     */
    public static function getDevice($default = false)
    {
        foreach (array_keys(static::$devices) as $device)
        {
            if (static::isDevice($device))
            {
                return $device;
            }
        }

        if ($default === false)
        {
            throw new DeviceNotDetectedException('Could not detect device.');
        }

        return $default;
    }

    /**
     * Detect wether it's a certaim device
     *
     * @param   string   $device  device name
     * @return  boolean  wether it's a device
     */
    protected static function isDevice($device)
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];

        return (bool) preg_match('/' . static::$devices[$device] . '/i', $ua);
    }
}
