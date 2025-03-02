<?php

abstract class View
{   
    public static array $cookies, $headers;
    private static Template $base;
    
    public static function getBase(): Template {
        return self::$base;
    }

    public static function setBase(Template $base): void {
        self::$base = $base;
    }
    
    public static function Init(Template $base)
    {
        ob_start();
        self::setBase($base);
        self::$cookies = array();
        self::$headers = array("Content-type: text/html");
    }

    public static function PrintFinal() : void
    {
        ob_end_clean();
        foreach (self::$cookies as $cookie)
        {
            setcookie($cookie["key"], $cookie["value"], $cookie["time"]);
        }
        foreach (self::$headers as $header)
        {
            header($header);
        }
        print(self::$base->Render(true));
    }
    
    public static function SetCookie(string $key, string $value, int $time)
    {
        self::$cookies[] = ["key" => $key, "value" => $value, "time" => $time];
    }
    
    public static function SetFinalHeader(string $header)
    {
        ob_end_clean();
        header($header);
        exit();
    }
}
