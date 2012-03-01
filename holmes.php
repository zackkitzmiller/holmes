<?php

/**
* Holmes
* Based On http://code.google.com/p/php-mobile-detect/	
* @modified Zack Kitzmiller
*/
class Holmes
{
    // regex and patterns from php-mobile-detect
    private static $devices = array(
        "android" => "android.*mobile",
        "androidtablet" => "android(?!.*mobile)",
        "blackberry" => "blackberry",
        "blackberrytablet" => "rim tablet os",
        "iphone" => "(iphone|ipod)",
        "ipad" => "(ipad)",
        "ios" => "(iphone|ipod|ipad)",
        "palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows" => "windows ce; (iemobile|ppc|smartphone)",
        "windowsphone" => "windows phone os",
        "generic" => "(kindle|mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
    );

    public static function is_mobile() {
        $accept = $_SERVER['HTTP_ACCEPT'];
		
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE']))
        {
            return true;
        }
        elseif (strpos($accept, 'text/vnd.wap.wml') > 0 || strpos($accept, 'application/vnd.wap.xhtml+xml') > 0)
        {
            return true;
        }
        else
        {
            foreach (array_keys(self::$devices) as $device)
            {
                if (self::is_device($device)) return true;
            }
        }
        return false;
    }

    public static function get_device() {
        foreach (array_keys(self::$devices) as $device)
        {
            if (self::is_device($device)) return $device;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $device = array_pop(explode('_', $name));
        if (array_key_exists($device, self::$devices)) {
            return self::is_device($device);
        }
        else
        {
            throw new Exception('Invalid Method');
        }
    }

    public static function is_device($device)
    {
        $ua = $_SERVER['HTTP_USER_AGENT'];	
        return (bool)preg_match("/" . self::$devices[$device] . "/i", $ua);
    }

}